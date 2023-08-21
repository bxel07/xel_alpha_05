<?php

namespace setup\security;
use Gemstone\main;


class csrf_shielded{

    protected main $main;


    private array $token = [
        'type1' =>'Diamond', 'type2' => 'Ruby', 'type3'=>'Sapphire', 'type4' => 'Lapis Lazuli'
    ];

    /**
     * Constructor class to inject object data
     */
    public function __construct()
    {
        $this->main = new main();
    }

    /**
     * @return string|null
     * @throws \Exception
     * Token Based Gemstone Generator
     */
    public function create_token() {
        $shuffledValues = array_values($this->token);
        shuffle($shuffledValues);

        $shuffledArray = array_combine(array_keys($this->token), $shuffledValues);

        return $this->generate($shuffledArray);

    }

    /**
     * @throws \Exception
     */
    private function generate(array $data = []) {

        // randomize the token
        $randomKey = array_rand($data);
        $randomValue = $data[$randomKey];


        //random length
        $randlength = random_int(32,128);

        //random string
        $random_key [] = substr(bin2hex(random_bytes($randlength)), 0, $randlength);

        return $this->main->ed($randomValue, $random_key);
    }

}