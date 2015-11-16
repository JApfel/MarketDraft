<?php

	use Phalcon\Mvc\Controller;
	use Phalcon\Paginator\Adapter\Model as Paginator;
	
	class SearchController extends Controller	{
	
		function indexAction()	{
			$q = $this->request->getQuery('q');
			$address = $this->request->getQuery('address');
			
			$apiLink = $this->config->maps->api_link;
			
			$geoData = file_get_contents($apiLink . urlencode($address));
			if($geoData === FALSE)	{
				die("Error retrieving address");
			}
			
			$geoJSON = json_decode($geoData);
			if($geoJSON->status == "OK")	{
				$geometry = $geoJSON->results[0]->geometry->location;
				$lat = $geometry->lat;
				$lng = $geometry->lng;
			}
			else	{
				$lat = 0;
				$lng = 0;
			}
			
			$radius = 10000;
			
			require("../vendor/sphinxsearch-api/sphinxapi.php");
			
			$sphinxClient = new SphinxClient();
			$sphinxClient->setServer('localhost', 9312);
			
			$sphinxClient->setMatchMode(SPH_MATCH_ANY);
			
			$sphinxClient->setGeoAnchor('latitude', 'longitude', deg2rad(floatval($lat)), deg2rad(floatval($lng)));
			
			$sphinxClient->setFilterFloatRange('@geodist', 0.0, floatval($radius));
			
			$results = $sphinxClient->query($q);
			
			$matches = $results['matches'];
			
			$ids = array();
			$geodists = array();
			
			foreach($matches as $match)	{
				$attrs = $match['attrs'];
				array_push($ids, $attrs['pid']);
				array_push($geodists, round($attrs['@geodist'] / 1600));
			}
			
			$builder = $this->modelsManager->createBuilder();
			
			$results = $builder->from('Providers')
							->inWhere('id', $ids)
							->getQuery()
							->execute();
			
			$currentPage = (int) $_GET["page"] == 0 ? 1: (int) $_GET["page"];
			
			$paginator = new Paginator(array(
				"data" => $results,
				"limit"=> 10,
				"page" => $currentPage
			));
			
			$numPages = 6;
				
			$page = $paginator->getPaginate();
			
			if($currentPage > $numPages / 2)	{
				$startPage = $currentPage - $numPages / 2;
			}
			else	{
				$startPage = 1;
			}
			
			$endPage = $startPage + $numPages - 1;
			
			if($endPage > $page->last)	{
				$endPage = $page->last;
			}
			
			$this->view->startPage = $startPage;
			$this->view->endPage = $endPage;
			
			$this->view->page = $page;
			
			$this->view->q = $q;
			$this->view->address = $address;
			
			$this->view->geodists = $geodists;
			
			echo $this->view->render('search', 'index');
		}
	}