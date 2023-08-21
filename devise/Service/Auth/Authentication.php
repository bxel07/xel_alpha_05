<?php

namespace devise\Service\Auth;
use setup\baseclass\BaseServise;
use setup\config\RequestHandler;
use setup\security\Gems_Auth;


class  Authentication extends BaseServise {
    private Gems_Auth $auth;
    private RequestHandler $handler;

    /**
     * @param Gems_Auth $auth
     * @param RequestHandler $handler
     */
    public function __construct(

        RequestHandler $handler,
        Gems_Auth $auth

    )
    {
        $this->auth = $auth;
        $this->handler = $handler;
    }

    /**
     * @return void
     */
    public function register(): void
    {
       $this->render('Auths/register');
    }

    public function do_register() {
        //get data
        $data = $this->handler->request();

        //query data
        $this->xgen()->insert('users', [
            "username" => $data->username ,
            "email" => $data->email,
            "password" => $data->password
        ]);

        //secure process after implemented
        $this->handler->secure_data();

        //redirect code
        $this->redirect('/login');
    }

    /**
     * @return void
     */
    public function login(): void
    {
        $this->render('Auths/login');
    }

    /**
     * @return void
     */
    public function do_login(): void
    {
        //getting data
        $data = $this->handler->request();


        // handling validator email password process validation
        $validation = $this->auth->schema('users',
            $this->auth->validator = [
                'email' => $data->email,
                'password' => $data->password
            ]
        );


        // check validation and redirection
        if($validation) {
            $this->auth->start_session('100','100');
            $this->auth->redirect('/auth/dashboard');
        } else{
            echo "email or password error!! please insert correct email & password";
            $this->redirect('/login');
        }

        $this->handler->secure_data();

    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->auth->endSession();
        $this->auth->redirect('/login');
    }


}
