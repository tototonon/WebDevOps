<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


use Respect\Validation\Validator;
use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\mvc\model\User;
use TononT\Webentwicklung\mvc\view\Auth\Login as LoginView;
use TononT\Webentwicklung\mvc\view\Auth\Register as RegisterView;
use TononT\Webentwicklung\Repository\UserRepository;

class Auth extends AbstractController
{

    /**
     * @param IRequest $request
     * @param IResponse $response
     * @throws \Exception
     */
    public function register(IRequest $request, IResponse $response): void
    {
        if(!$request->hasParameter('username')) {
            $view = new RegisterView();
            $response->setBody($view->render([]));
        } else {
            Validator::allOf(Validator::notEmpty(), Validator::stringType())->check($request->getParameters()['username']);
            Validator::allOf(
                Validator::notEmpty(),
                Validator::stringType()
            )->check($request->getParameters()['password']);
            $user = new User();
            $user->username= $request->getParameter('username'); // coming from our form via $_POST/$_REQUEST
            $user->password = $request->getParameter('password'); // coming from our form via $_POST/$_REQUEST

            $userRepository = new UserRepository();
            $userRepository->addUser($user);
            $response->setBody("Welcome".$user->username);
        }
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     * @throws \Exception
     */
    public function login(IRequest $request, IResponse $response): void
    {
        if(!$request->hasParameter('username')) {
            // render the form
            $view = new LoginView();
            $response->setBody($view->render([]));
        } else {
            // do the validation here
            Validator::allOf(
                Validator::notEmpty(),
                Validator::stringType(),
                Validator::email()
            )->check($request->getParameters()['username']);
            Validator::allOf(
                Validator::notEmpty(),
                Validator::stringType()
            )->check($request->getParameters()['password']);

            $username = $request->getParameter('username'); // coming from our form via $_POST/$_REQUEST
            $password = $request->getParameter('password'); // coming from our form via $_POST/$_REQUEST

            // test if user exists
                $userRepository = new UserRepository();
                $user = $userRepository->getByUsername($username);
                $hash = '';
                // user testing deferred for timing reasons
                if($user instanceof User) {
                    $hash = $user->password;
                }
                /// test if the password is correct
                if(password_verify($password,$hash) && ($user instanceof User)) {
                    // test if the password needs rehash
                    if(password_needs_rehash($hash, PASSWORD_DEFAULT)) {
                        $rehashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        if(!is_string($rehashedPassword)) {
                            throw new \Exception('Could not update user to rehash password');
                        }
                        $user->password = $rehashedPassword;
                        $userRepository->update($user);
                    }
                    /// login SUCCESSFUL
                    $this->getSession()->login();
                    $response->setBody('great success');
                } else {
                    // login failed
                    $response->setStatusCode(401);
                    $response->setBody('login failed');
                }
            }
        }


    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function logout(IRequest $request, IResponse $response): void
    {
        $this->getSession()->destroy();
    }
}
