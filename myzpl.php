<?php
/*
 * Send ZPL code to Zebra printers using sockets
 * 
 * Zebra printers allows printing from web interface, simply connects to the Zebra Printer using sockets.
 * 
 * IP ADDRESS:
 * Set and Validate the Zebra IP Address with set_and_validate_IP($IP_Address) before to send information.
 * 
 * PORT NUMBER:
 * Zebra printers by default use 9100 port and you can change it by using set_Port($port) 
 * 
 * ZPL CODE:
 * Test ZPL representation for Zebra is added in function test_ZPL().
 * It is better Zebra tools to create ZPL templates and labels
 * but we can use http://labelary.com/viewer.html
 * for a visual representation. 
 * 
 * 
 * GNU GENERAL PUBLIC LICENSE
 * 
 * Created by: 	Hector Manuel Alonso Ortiz
 * eMail: 		alonso.hector@gmail.com
 * Github: 		https://github.com/alonsohector/MyZPL
 * 
 */
 
/* MyZPL  */


class MyZPL {
	
    /**
     * A ZPL template code to be printed
     * @var string
     */
    private $str_ZPL;

	/**
     * A reference Zebra IP to use
     * @var string
     */
	private $Zebra_IP;
	 
    /**
     * Validated IP to use
     * @var boolean
     */
	private $IP_Validated;	
	
	/**
     * Zebra Port to connect socket
     * @var number
     */
    private $Port_Zebra;


		
	function __construct($IP_Address) {
		print "Start MyZPL <br>";
		$this->set_and_validate_IP($IP_Address);
		//set by default 9100 port for Zebra printers, you can review it in Zebra printer configurations
		$this->Port_Zebra = 9100;

	}


	/*
	* Set and Validate the Zebra IP Address - We will need a correct information, Linux sockets are critical with performance.
	*/
	public function set_and_validate_IP($IP_Address)
	{
		$b_return = false;

		//Validate IP Address
		if (filter_var($IP_Address, FILTER_VALIDATE_IP)) {
			echo("$IP_Address is a valid IP address.<br>");
			//set values in IP Address
			$this->Zebra_IP = $IP_Address;	
			$b_return = true;
		} else {
			echo("$IP_Address is not a valid IP address.<br>");
			$b_return = false;
		}	
		$this->IP_Validated = $b_return;

		return $b_return;
	}

	/*
	* Test ZPL representation for Zebra.
	* It is better Zebra tools to create ZPL templates and labels
	* but we can use http://labelary.com/viewer.html
	* for a visual representation.
	*/
	public function test_ZPL()
	{
		$zpl= <<<END
		^XA

		^FX Top section with company logo, name and address.
		^CF0,60
		^FO50,50^GB100,100,100^FS
		^FO75,75^FR^GB100,100,100^FS
		^FO88,88^GB50,50,50^FS
		^FO220,50^FDIntershipping, Inc.^FS
		^CF0,30
		^FO220,115^FD1000 Shipping Lane^FS
		^FO220,155^FDShelbyville TN 38102^FS
		^FO220,195^FDUnited States (USA)^FS
		^FO50,250^GB700,1,3^FS
		
		^FX Second section with recipient address and permit information.
		^CFA,30
		^FO50,300^FDJohn Doe^FS
		^FO50,340^FD100 Main Street^FS
		^FO50,380^FDSpringfield TN 39021^FS
		^FO50,420^FDUnited States (USA)^FS
		^CFA,15
		^FO600,300^GB150,150,3^FS
		^FO638,340^FDPermit^FS
		^FO638,390^FD123456^FS
		^FO50,500^GB700,1,3^FS
		
		^FX Third section with barcode.
		^BY5,2,270
		^FO100,550^BC^FD12345678^FS
		
		^FX Fourth section (the two boxes on the bottom).
		^FO50,900^GB700,250,3^FS
		^FO400,900^GB1,250,3^FS
		^CF0,40
		^FO100,960^FDCtr. X34B-1^FS
		^FO100,1010^FDREF1 F00B47^FS
		^FO100,1060^FDREF2 BL4H8^FS
		^CF0,190
		^FO470,955^FDCA^FS
		
		^XZ

END;

		return $zpl;
		
	}

	/*
	* Set ZPL representation for Zebra.
	*/
	public static function set_ZPL($zpl)
	{
		$this->str_ZPL= <<<END
		{$zpl}
END;
	}

	/*
	* Get ZPL representation for Zebra.
	*/
	public function get_ZPL($zpl)
	{
		return $this->str_ZPL;
	}

	/*
	* Get IP Address validation to start sending ZPL information to Zebra.
	*/
	public function get_IP_Validated()
	{
		return $this->IP_Validated;
	}


	/*
	* Set Zebra port to start socket.
	*/
	public static function set_Port($port)
	{
		$this->Port_Zebra = $port;
	}


	/*
	* Send ZPL information to Zebra printer.
	* Zebra by default declare 9100 as port number, so you can change it if you need
	* using function set_Port() to change Port_Zebra value
	*/
	public function send_ZPL()
	{
		$sended = false;
		
		if($this->get_IP_Validated())
		{
			try
			{
				
				/*
				* Socket 
				* Open persistent Internet or Unix domain socket connection
				* ((PHP 4, PHP 5, PHP 7))
				*/
				$fp=pfsockopen($this->Zebra_IP,$this->Port_Zebra);
				if ($fp) 
				{
					fputs($fp,$this->str_ZPL);
					//Important to call fclose() on socket handle when fwrite() returns false.
					fclose($fp);
					echo "Successfully Printed";
				}
				else
				{
					echo "<br> Unable to connect to ".$this->Zebra_IP.", using this port: ".$this->Port_Zebra;
				}
	
			}
			catch (Exception $e) 
			{
				//echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo "Error sending information.";
			}
		}
		else
		{
			echo "Review IP Address before to send information.";
		}

	
	}

 }

 
 


/*
*	Test MyZPL class
*   
*
*/

$IP_Address = "192.168.1.10";

$zpl = new MyZPL($IP_Address);

//change port if it is needed 
//$port = "9100";
//$zpl->set_Port($port)

//create a ZPL Test
$zpl->test_ZPL();

//or you can send zpl code
//$zpl_code = "zpl code template";
//$zpl->set_ZPL($zpl_code);

//send information to Zebra Printer
$zpl->send_ZPL();



?>