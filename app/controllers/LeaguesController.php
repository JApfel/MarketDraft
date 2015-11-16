<?php

	use Phalcon\Mvc\Controller;
	use Phalcon\Http\Response;
	
	class LeaguesController extends Controller	{
	
		function indexAction()	{
			$uid = $this->session->get('user');
			
			$user = Users::findFirst("id = '$uid'");
			
			$userLeagues = $user->userLeagues;
			
			$this->view->userLeagues = $userLeagues;
		
			echo $this->view->render('leagues', 'index');
		}
		
		function showAction($id)	{
			$response = new Response();
			
			if(!$id)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "No id was specified."
				);
				return $response->setJsonContent($error);
			}
			
			$league = Leagues::findFirst("id = '$id'");
			
			if(!$league)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "The league does not exist."
				);
				return $response->setJsonContent($error);
			}
			
			$uid = $this->session->get('user');
			
			$lid = $league->id;
			
			$userLeague = UserLeagues::findFirst("lid = '$lid' AND uid = '$uid'");
			
			if(!$userLeague)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "You are not a member of this league."
				);
				return $response->setJsonContent($error);
			}
			
			$this->view->league = $league;
			
			echo $this->view->render('leagues', 'show');
		}
		
		function newAction()	{
			echo $this->view->render('leagues', 'new');
		}
		
		function createAction()	{
			if($this->request->isPost())	{
				
				$response = new Response();
				
				$name = $this->request->getPost('name');
				
				if(!$name)	{
					$error = array(
                        "status"    =>   "error",
                        "message"   =>   "You must enter a league name."
                    );
					
                    return $response->setJsonContent($error);
				}
				
				$leagues = Leagues::find("name = '$name'");
				
				if(count($leagues))	{
					$error = array(
                        "status"    =>   "error",
                        "message"   =>   "A league with this name already exists."
                    );
					
                    return $response->setJsonContent($error);
				}
				
				$uid = $this->session->get('user');
				
				$league = new Leagues();
				
				$league->name = $name;
				$league->admin_id = $uid;
				
				$userLeague = new UserLeagues();
				
				$userLeague->uid = $uid;
				$userLeague->leagues = $league;
				
				if(!$userLeague->create())	{
					$error = array(
                        "status"    =>   "error",
                        "message"   =>   "There was an error creating the league."
                    );
                    return $response->setJsonContent($error);
				}
				
				$success = array(
					"status"    =>   "success",
					"message"   =>   "http://" . $_SERVER['HTTP_HOST'] . "/leagues/" . $league->id
				);
				
				return $response->setJsonContent($success);
			}
		}
		
		function editAction($id)	{
			$response = new Response();
			
			if(!$id)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "No id was specified."
				);
				return $response->setJsonContent($error);
			}
			
			$league = Leagues::findFirst("id = '$id'");
			
			if(!$league)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "The league does not exist."
				);
				return $response->setJsonContent($error);
			}
			
			$this->view->league = $league;
			
			echo $this->view->render('leagues', 'edit');
		}
		
		function updateAction($id)	{
			$response = new Response();
		
			$league = Leagues::findFirst("id = '$id'");
		
			$uid = $this->session->get('user');
			
			if($league->admin_id != $uid)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "You do not have permission to edit this league."
				);
				return $response->setJsonContent($error);
			}
			
			$fields = array('name');
			
			$name = $this->request->getPost('name');
			
			if(!$name)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "You must enter a league name."
				);
				return $response->setJsonContent($error);
			}
			
			$league->name = $name;
			
			if(!$league->save())	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "There was an error updating the league."
				);
				return $response->setJsonContent($error);
			}
			
			$success = array(
				"status"    =>   "success"
			);
			
			return $response->setJsonContent($success);
		}
		
		function deleteAction($id)	{
			$response = new Response();
			
			if(!$id)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "No id was specified."
				);
				return $response->setJsonContent($error);
			}
			
			$league = Leagues::findFirst("id = '$id'");
			
			if(!$league)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "The league does not exist."
				);
				return $response->setJsonContent($error);
			}
			
			$uid = $this->session->get('user');
			
			if($league->admin_id != $uid)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "You do not have permission to delete this league."
				);
				return $response->setJsonContent($error);
			}
			
			if(!$league->delete())	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "There was an error deleting the league."
				);
				return $response->setJsonContent($error);
			}
			
			$success = array(
				"status"    =>   "success"
			);
			
			return $response->setJsonContent($success);
		}
		
		function joinAction($id)	{
			$response = new Response();
		
			if(!$id)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "No id was specified."
				);
				return $response->setJsonContent($error);
			}
			
			$league = Leagues::findFirst("id = '$id'");
			
			if(!$league)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "The league does not exist."
				);
				return $response->setJsonContent($error);
			}
			
			$uid = $this->session->get('user');
			
			$lid = $league->id;
			
			$userLeague = UserLeagues::findFirst("lid = '$lid' AND uid = '$uid'");
			
			if($userLeague)	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "You are already a member of this league."
				);
				return $response->setJsonContent($error);
			}
			
			$userLeague = new UserLeagues();
			
			$userLeague->uid = $uid;
			$userLeague->lid = $lid;
			
			if(!$userLeague->create())	{
				$error = array(
					"status"    =>   "error",
					"message"   =>   "There was an error creating the league membership."
				);
				return $response->setJsonContent($error);
			}
			
			$success = array(
				"status"    =>   "success"
			);
			
			return $response->setJsonContent($success);
		}
	}