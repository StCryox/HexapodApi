<?PHP

Class Parcours {
    public $id;
    public $name;
    public $command;

    public function __construct($name,$command) {
        $this->name    = $name;
        $this->command = $command;
    }

    public static function withId($id, $name,$command) {
        $parcours = new Self($name, $command);

        $parcours->id = $id;

        return $parcours;
    }
}