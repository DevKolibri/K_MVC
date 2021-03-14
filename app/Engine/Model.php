<?
 namespace app\Engine;

    use app\Engine\DataBase;
    use app\Engine\Payments\Qiwi;

    use lib\ZipArchive;

    abstract class Model {

	public $db;
	public $qiwi;
	
    
	
	public function __construct() {
        $misc = require 'config/misc.php';

        
		$this->db = new DataBase;
		if (isset($misc['Qiwi'])) {
			$this->qiwi = new Qiwi($misc['Qiwi']['phone'],$misc['Qiwi']['token']);
		}

	}

}