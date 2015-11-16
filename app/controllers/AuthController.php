<?php

	use Phalcon\Mvc\Controller;
	
	class AuthController extends Controller	{
	
		function loginAction()	{
		
			if($this->request->isPost())	{
				$fields = array('username', 'password');
				
				foreach($fields as $field)	{
					${$field} = $this->request->getPost($field);
				}
				
				$errors = array();
				
				if($password && $username) {
                    $user = Users::findFirst("username = '$username'");
                     
                    if($user)  {
						if($user->verify($password)) {
                            $this->session->set("user", $user->id);
                            $this->redirect();
                        }
                        else    {
                            array_push($errors, "The password entered is incorrect.");
                        }
                    }
                    else    {
                        array_push($errors, "The username is not registered.");
                    }
                }
                else    {
                    array_push($errors, "Both fields must be entered.");
                }
			}
			
			$this->view->signedUp = $this->request->hasQuery('success');
			
			echo $this->view->render('auth', 'login');
		}
		
		function signupAction()	{
			
			if($this->request->isPost())	{
				$fields = array('username', 'email', 'password', 'cpassword');
				
				$fieldsEntered = 0;
				
				foreach($fields as $field)	{
					${$field} = $this->request->getPost($field);
					if(trim(${$field}) != '')	{
						$fieldsEntered++;
					}
				}
				
				$errors = array();
				
				if($fieldsEntered < count($fields))	{
					array_push($errors, "Some fields were not entered.");
				}
				
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
					array_push($errors, "Email is invalid.");
				}
					
				if(strlen($password) < 6)	{
					array_push($errors, "Password must be at least 6 characters long.");
				}
				
				if($password != $cpassword)	{
					array_push($errors, "Passwords don't match.");
				}
				
				$user = Users::findFirst("email = '$email' OR username = '$username'");
				
				if($user)	{
					array_push($errors, "Email or username is already taken.");
				}
				
				if(!count($errors))	{
					$salt = bin2hex(openssl_random_pseudo_bytes(16, $cstrong));
					
					$user = new Users();
					$user->username = $username;
					$user->email = $email;
					$user->salt = $salt;
					$user->password = md5($salt . $password);
					
					if($user->create())	{
						$this->response->redirect('/login?success');
						$this->view->disable();
					}
					else	{
						array_push($errors, "An error occurred during the signup process.");
					}
				}
				
				$this->view->errors = $errors;
			}
			
			echo $this->view->render('auth', 'signup');
		}
		
		function providerSignupAction()	{
			
			if($this->request->isPost())	{
				$name = $this->request->getPost('name');
				$email = $this->request->getPost('email');
				$password = $this->request->getPost('password');
				$cpassword = $this->request->getPost('cpassword');
				$timezone = $this->request->getPost('timezone');
				$phone = $this->request->getPost('phone');
				$address = $this->request->getPost('address');
				$categories = $this->request->getPost('categories');
				$membership = $this->request->getPost('membership');
				$card_token = $this->request->getPost('card_token');
				
				$errors = array();

				$fields = array('name', 'email', 'password', 'cpassword', 'phone', 'address', 'membership', 'card_token');
				$fieldsEntered = 0;
				
				foreach($fields as $field)	{
					if(trim(${$field}) != '')	{
						$fieldsEntered++;
					}
				}
				
				if($fieldsEntered < count($fields))	{
					array_push($errors, "Some fields were not entered.");
				}
				
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
					array_push($errors, "Email is invalid.");
				}
					
				if(strlen($password) < 6)	{
					array_push($errors, "Password must be at least 6 characters long.");
				}
				
				if($password != $cpassword)	{
					array_push($errors, "Passwords don't match.");
				}
				
				if(!preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $phone))	{
					array_push($errors, "Invalid phone number format.");
				}
				
				$apiLink = $this->config->maps->api_link;
				
				$geoData = file_get_contents($apiLink . urlencode($address));
				if($geoData === FALSE)	{
					array_push($errors, "Invalid address.");
				}
				
				$provider = Providers::findFirst("email = '$email'");
				
				if($provider)	{
					array_push($errors, "Email is already taken.");
				}
				
				if(!count($errors))	{
					$salt = bin2hex(openssl_random_pseudo_bytes(16, $cstrong));
					
					$provider = new Providers();
					$provider->name = $name;
					$provider->email = $email;
					$provider->salt = $salt;
					$provider->password = md5($salt . $password);
					$provider->timezone = $timezone;
					$provider->membership = $membership;
					
					require_once("../vendor/stripe-php-master/init.php");
					
					\Stripe\Stripe::setApiKey($this->config->stripe->secret_key);
					
					$plan = Memberships::findFirst("id = '$membership'");
					
					$amount = ((int) $plan->total) * 100;
					$duration = $plan->duration;
					
					$date = new DateTime(date());
					$date->add(new DateInterval('P' . $duration . 'M'));
					
					$provider->expiry_date = $date->format('Y-m-d H:i:s');
					
					$account = \Stripe\Account::create(array(
						"managed" => true,
						"country" => "US"
					));
					
					$provider->stripe_account_token = $account->id;
					
					$customer = \Stripe\Customer::create(array(
						"description" => $name,
						"email" => $email,
						"source" => $card_token
					));
					
					$provider->stripe_customer_token = $customer->id;
					$provider->stripe_card_token = $customer->default_source;
					
					$providerPhone = new ProviderPhones();
					$providerPhone->telephone = $phone;
					$provider->providerPhones = $providerPhone;
					
					$providerAddress = new ProviderAddresses();
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
					$providerAddress->latitude = $lat;
					$providerAddress->longitude = $lng;
					$providerAddress->address = $address;
					$provider->providerAddresses = $providerAddress;
					
					$providerCategories = array();
					
					foreach($categories as $category)	{
						$providerCategory = new ProviderCategories();
						$providerCategory->cid = $category;
						array_push($providerCategories, $providerCategory);
					}
					
					$provider->providerCategories = $providerCategories;
					
					if($provider->create())	{
						\Stripe\Charge::create(array(
							"amount" => $amount,
							"currency" => "usd",
							"customer" => $provider->stripe_customer_token,
							"source" => $provider->stripe_card_token,
							"description" => "$plan->name plan subscription"
						));
						
						$this->response->redirect('/login?success');
						$this->view->disable();
					}
					else	{
						array_push($errors, "An error occurred during the signup process.");
					}
				}
				
				$this->view->errors = $errors;

			}
			
			$timezones = require("../app/config/timezones.php");
			$this->view->timezones = $timezones;
			
			$memberships = Memberships::find("id > 1");
			$this->view->memberships = $memberships;
			
			$categories = Categories::find();
			$this->view->categories = $categories;
			
			echo $this->view->render('auth', 'providerSignup');
		}
		
		function forgotPasswordAction()	{
			if($this->request->isPost())	{
				$email = $this->request->getPost('email');
				
				$errors = array();
				
				$user = Users::findFirst("email = '$email'");
		
				if(!$user)	{
					$provider = Providers::findFirst("email = '$email'");
					if(!$provider)	{
						array_push($errors, "The email is not registered.");
					}
					else	{
						$id = $provider->id;
						$type = 'provider';
					}
				}
				else	{
					$id = $user->id;
					$type = 'user';
				}
				
				if(!count($errors))	{
					require_once("../vendor/phpmailer/PHPMailerAutoload.php");
					
					if($type == 'user')	{
						$password = $user->password;
						$salt = $user->salt;
					}
					else	{
						$password = $provider->password;
						$salt = $provider->salt;
					}
					
					$hash = md5($salt . $password);
					
					$resetLink = "http://159.203.94.226/resetPassword?id=$id&type=$type&hash=$hash";
					
					$subject = "Password Reset";
					$message = "Click here to reset your password: $resetLink";
					
					$credentials = $this->config->mail;
					$mailer = new PHPMailer();
					$mailer->isSMTP();
					$mailer->SMTPAuth = true;
					$mailer->Host = $credentials->smtp->server;
					$mailer->Username = $credentials->smtp->username;
					$mailer->Password = $credentials->smtp->password;
					$mailer->SMTPSecure = 'tls';
					$mailer->Port = $credentials->smtp->port;
					$mailer->From = $credentials->fromEmail;
					$mailer->FromName = $credentials->fromName;
					$mailer->addAddress($email);
					$mailer->isHTML(true);
					$mailer->Subject = $subject;
					$mailer->Body = $message;
					
					if($mailer->send())	{
						echo "An email was sent with a password reset link.";
						$this->view->disable();
					}
					else{
						array_push($errors, "There was an error sending the email. Please try again.");
					}
				}
				
				$this->view->errors = $errors;
			}
			
			echo $this->view->render('auth', 'forgotPassword');
		}
		
		function resetPasswordAction()	{
			
			$id = $this->request->getQuery('id');
			$type = $this->request->getQuery('type');
			$hash = $this->request->getQuery('hash');
			
			if($type == 'user')	{
				$user = Users::findFirst("id = '$id'");
			}
			else	{
				$user = Providers::findFirst("id = '$id'");
			}
			
			$estimatedHash = md5($user->salt . $user->password);
			
			if(!$type || ($estimatedHash != $hash))	{
				echo "Invalid reset link.";
				$this->view->disable();
			}
			
			if($this->request->isPost())	{
				$newpassword = $this->request->getPost('newpassword');
				$confirmpassword = $this->request->getPost('confirmpassword');
				
				$errors = array();
				
				if(strlen($newpassword) < 6)	{
					array_push($errors, "Password must be at least 6 characters long.");
				}
				
				if($newpassword != $confirmpassword)	{
					array_push($errors, "Passwords don't match.");
				}
				
				if(!count($errors))	{
					
					$salt = bin2hex(openssl_random_pseudo_bytes(16, $cstrong));
					
					$user->salt = $salt;
					$user->password = md5($salt . $newpassword);
					
					if($user->save())	{
						echo "Password has been reset.";
						$this->view->disable();
					}
				}
				
				$this->view->errors = $errors;
				
			}
			
			echo $this->view->render('auth', 'resetPassword');
		}
		
		function updateStatusAction()	{
			$status_code = $this->request->getPost('status_code');
			if($this->session->has('user'))	{
				$uid = $this->session->get('user')->id;
				$user = Users::findFirst("id = '$uid'");
				$user->online = $status_code;
				$user->save();
			}
			else	{
				$pid = $this->session->get('provider')->id;
				$provider = Providers::findFirst("id = '$pid'");
				$provider->online = $status_code;
				$provider->save();
			}
		}
		
		function redirect()	{
			$this->response->redirect(ltrim($this->request->getQuery('continue', '/'), '/'));
			$this->view->disable();
		}
		
		function logoutAction()	{
			$this->session->destroy();
			$this->redirect();
		}
		
	}