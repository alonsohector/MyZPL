# MyZPL

## Send ZPL code to Zebra printers using sockets


Zebra printers allows printing from web interface, simply connects to the Zebra Printer using sockets.
  
 **IP ADDRESS:**
  Set and Validate the Zebra IP Address with set_and_validate_IP($IP_Address) before to send information.
  
 **PORT NUMBER:**
  Zebra printers by default use 9100 port and you can change it by using set_Port($port) 
  
 **ZPL CODE:**
  <p>Test ZPL representation for Zebra is added in function test_ZPL().</p>
  <p>It is better Zebra tools to create ZPL templates and labels</p>
  <p>but we can use ZPL online viewer [LABELARY](http://labelary.com/viewer.html) </p>
  <p>for a visual representation. </p>
  
<hl>
  <p align="center">
      <h2>How to use MyZPL</h2>
  </p> 
<hl>
  
<p>
  Start with using IP Address and change the Port number if you need it, set the ZPL code and send it to Zebra printer.
</p>  

<p>
  **Easy !!!**
</p>  


<pre>
/*
*	Test MyZPL class
*/

$IP_Address = "192.168.1.10";

//Start class using Zebra IP Address 
$zpl = new MyZPL($IP_Address);

//Change port if it is needed 
//$port = "9100";
//$zpl->set_Port($port)

//create a ZPL Test code
$zpl->test_ZPL();

//or you can set zpl code 
//$zpl_code = "zpl code template";
//$zpl->set_ZPL($zpl_code);

//send information to Zebra Printer
$zpl->send_ZPL();

</pre>
  
  <p>
   
  </p>
  
  
  ##GNU GENERAL PUBLIC LICENSE
  
  Created by: 	**Hector Manuel Alonso Ortiz**
  eMail: 		**alonso.hector@gmail.com**
  Github: 		**https://github.com/alonsohector/MyZPL**
