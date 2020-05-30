<?PHP

Class Parcours {
    public $id;
    public $name;
    public $command;

    public function __construct($id,$name,$command) {
        $this->id      = $id;
        $this->name    = $name;
        $this->command = $command;
    }
    
    public static function constructor2($name, $command) {
        $this->name    = $name;
        $this->command = $command;
    }

}