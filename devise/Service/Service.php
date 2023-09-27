<?php
namespace devise\Service;
use devise\Middleware\Middleware;
use setup\baseclass\BaseServise;
use setup\config\http;
use setup\config\RequestHandler;
use setup\config\xgen;
use setup\system\core\Router\AttributeCollections\Route;
use setup\system\core\Router\AttributeCollections\RouterGroup;

//#[RouterGroup(prefix: '/auth', status: true)]
class Service extends BaseServise{

    public function __construct
    (
        RequestHandler $requestHandler,
        public xgen $xgen
    )
    {
        parent::__construct($requestHandler);
    }

    #[Route(uri: '/',RequestMethod: http::GET, Middleware: [Middleware::class])]
    public function index() {
        $this->render('welcome');
    }

    #[Route(uri: '/edit/{id}', RequestMethod: http::GET)]
    public function edit(array $ando = []): void
    {
        $id = $ando['id'];
        // Now you can use the $id variable
        echo "<pre>";
        echo "ID: $id";
    }

    #[Route(uri: '/view', RequestMethod: http::GET)]
    public function gemstone(): void
    {
        $this->render('redirect');
    }



    #[Route(uri: '/result', RequestMethod: http::GET)]
    public function receive(): void
    {
        var_dump($this->requestHandler->request());
        $this->requestHandler->secure_data();
    }


    /**
     * @return void
     * for get all data on db
     */

    #[Route(uri: '/show' ,RequestMethod: http::GET)]
    public function show(){
       var_dump( $this->xgen->show('users'));
    }


    /**
     * @param array $id
     * @return void
     * For geting data from DB by id
     */

    #[Route(uri: '/showbyid/{id}' ,RequestMethod: http::GET)]
    public function showbyid(array $id = []){
        var_dump( $this->xgen->showById('users', $id['id']));
    }

    /**
     * @param array $id
     * @return void
     * For edit data by id
     */
    #[Route(uri: '/editdata/{id}' ,RequestMethod: http::GET)]
    public function editdata(array $id = []){
        $this->xgen->renew(
            'users',
            ['username' => 'doni'],
            $id['id']
        );
        var_dump( $this->xgen->showById('users', $id['id']));
    }

    /**
     * @return void
     * for insert data to selected db table
     */
    #[Route(uri: '/insert',RequestMethod: http::GET)]
    public function insert(): void
    {
        $this->xgen->insert(
            'users',
            [
                'username' => 'newusers',
                'email' =>'emailxs',
                'password' => '12345'
            ]
        );
        var_dump( $this->xgen->showById('users', 73));

    }

    /**
     * @return void
     * for delete seleceted data from db table based on id
     */
    #[Route(uri: '/delete',RequestMethod: http::GET)]
    public function delete(){
        $this->xgen->destroy('users', 73);
        var_dump( $this->xgen->showById('users', 73));
    }

}