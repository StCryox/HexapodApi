<?PHP

Class Parcours {
    public $name;
    public $command;

    public function __construct($name,$command) {
        $this->name    = $name;
        $this->command = $command;
    }
}