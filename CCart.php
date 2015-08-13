<?php

class CCart {
 
    protected $db        = null;
    protected $title      = null; 
    #public $price int;


//$database
public function __construct($database) {
    $this->db = $database;
    //$this->db = new CDatabase();  

  }

public function SetVariables()
    {
          $this->title    =  isset($_GET['title']) ? $_GET['title'] : null;
          $this->submit   =  isset($_POST['submit']) ? true : false; 
          $this->cartSession = isset($_SESSION['custumer_cart']) ? $_SESSION['custumer_cart'] : null;
          $this->id = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
          $this->SessId     = isset($_POST['SessId']) ? $_POST['SessId'] : null;

          $this->submit = isset($_POST['submit']) ? true : false; 
          $this->removeItem = isset($_POST['removeItem']) ? true : false; 
    }


public function AddToCart(){
        $this->SetVariables();

        if($this->submit) {
          $sql = 'SELECT * FROM Movie WHERE id = ?';
          $params = array($this->id);
          $res =$this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
           #skapa en session med kundvagn
          if(isset($res[0])) {
            $obj = $res[0];
              if (isset($_SESSION['custumer_cart'])) {
                  $_SESSION['custumer_cart'][] = array('Title' => $obj->title, 'Pris' => $obj->pris, 'År' => $obj->YEAR);
                  header('Location: movie.php');
              }
              else{
                   $_SESSION['custumer_cart'][] = array('Title' => $obj->title, 'Pris' => $obj->pris, 'År' => $obj->YEAR);
                  #dump($_SESSION['custumer_cart']);
                   header('Location: movie.php');
              }
           }
        }
    } 




    #fungerar!
public function RemoveItemFromCart(){
  $this->SetVariables();
    if (isset($this->SessId)) {
        foreach($_SESSION['custumer_cart'] as $k => $value) {
          #var_dump($value); # denna kör ut hela arrayn
          if($this->SessId === $value['Title']){
            #var_dump($value); # jag antar att arrayn ska ändå visas innan den blir unset, men inget visas
            unset($_SESSION['custumer_cart'][$k]);}
        }
    }
}



  public function RenderCart(){
      $this->SetVariables();
      $container =   " 
            <table class='table table-bordered'>
              <tr>
                  <th>Row</th> 
                  <th> Title </th>
                  <th>Årtal</th>
                  <th>Pris</th> 
                  <th>Radera</th> 
              </tr>";
            $pris = 0;
            $key = 1;
      if (is_array($this->cartSession)){
         foreach($_SESSION['custumer_cart'] as $key => $product){
            $removeItem = $product['Title'];
            $pris += $product['Pris'];
            $key++;
            $container .= "
            <tr>
                <td>{$key}</td>
                <td>" . $product['Title'] . "</td>
                <td>" . $product['År'] . "</td>
                <td>" . $product['Pris'] . "</td>
                <td>
                <form method=post>
                <button type='submit'  name='SessId' value='" . $product['Title'] ."'  class='btn btn-danger btn-lg btn-block'>Radera</button>
                 </form>
                </td>
            </tr>";}
            $container .="
               <tr>
                <th>Varor:</th> 
                <th>" .sizeof($this->cartSession)."</th>
                <th>Pris:</th>
                <th>{$pris}:-</th> 
                <th>
                  <input type='submit' name='noll' value='Töm' class='btn btn-default'/>
                   <input type='submit' name='noll' value='Köp' class='btn btn-success'/>
                </th> 
            </tr>
            </table>";    
        return $container; 
      }

    }
    

} 
