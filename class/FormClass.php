<?php

/**
* Class Form
* Generate a form
*/
class Formulaire {


  /**
  *  @var array Data given by the user through the form
  */
  private $_data = array();

  /**
  *@param string Optionnal default '' action path of form
  */
  public function  __construct($action = '') {
    ?>
    <div class="container">
      <form id="formulaire" action ="<?=$action ?>" method ="post" enctype= "multipart/form-data">
    <?php

  }


/**
*@return array All field names of form
*/
public function get_data() : array {
  return $this->_data;
}
  /**
  *@param string Label of the radio
  *@param array  All options of the radio
  *@param string Name of form field
  *@return void
  */
  public function add_radio ($label, $data_array, $name) : void {

    $this->_data[] = $name;

    ?>
    <div class="container">
      <div class = "form-group">
      <label for=""><?= $label; ?></label><br/>
      <?php

      foreach ($data_array as $key => $value) {
        ?>
        <div class="row">
          <div class="col">
            <input type="radio" name="<?= $name; ?>" <?php if($key == 0){ echo "checked"; } ?> />
            <label for=""><?= $value; ?></label> <br/>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
      <?php
  }

  /**
  *@param string Label of the list
  *@param array  All options of the list
  *@param string Name of form field
  *@return void
  */
  public function add_list ($label, $data_array, $name) : void {

    $this->_data[] = $name;

    ?>
    <div class="container">
      <div class = "form-group">
      <label for=""><?= $label; ?></label><br/>
      <?php
      ?>
        <select class="form-control" name="<?= $name; ?>">
          <?php
      foreach ($data_array as $key => $value) {
        ?>
            <option value="<?= $value; ?>"><?= $value; ?></option>
        <?php
      }
      ?>
    </select>
    </div>
  </div>
  <br/>
      <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal argument default = false : not required, put true if required
  *@param string Optionnal argument Placeholder
  *@return void
  */
  public function add_email($label, $name, $required = false , $placeholder = ''): void {
    $this->_data [] = $name;
    ?>
    <div class="form-group">
      <label for=""><?= $label; ?></label>
      <input type="email" name="<?= $name; ?>" class="form-control" placeholder="<?= $placeholder; ?>" <?php if($required){ echo "required"; } ?> >
    </div><br/>
    <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal argument default = false : not required, put true if required
  *@param bool Optionnal argument default = false : not checked, put true if checked by default
  *@return void
  */
  public function add_checkbox($label, $name, $required = false, $checked = false): void {
    $this->_data [] = $name;
    ?>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id = "<?=$name; ?>" name = "<?=$name; ?>"  <?php if($checked){ echo "checked"; } ?> <?php if($required){ echo "required"; } ?> />
        <label class="custom-control-label" for="<?= $name; ?>"><?= $label; ?></label>
    </div><br/>
    <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal argument default = false : not required, put true if required
  *@return void
  */
  public function add_date($label, $name, $required = false) : void {
      $this->_data [] = $name;
      ?>
      <div class = "form-group">
        <label for =""><?= $label; ?></label>
        <input type="date"  class = "form-control" name="<?= $name; ?>" <?php if($required){ echo "required"; } ?> >
      </div> <br/>
      <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal argument default = false : not required, put true if required
  *@return void
  */
  public function add_time($label, $name, $required = false) : void {
      $this->_data [] = $name;
      ?>
      <div class = "form-group">
        <label for =""><?= $label; ?></label>
        <input type="time"  class = "form-control" name="<?= $name; ?>" <?php if($required){ echo "required"; } ?> >
      </div> <br/>
      <?php
  }


  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal argument default = false : not required, put true if required
  *@return void
  */
  public function add_month($label, $name, $required = false) : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
      <label for =""><?= $label; ?></label>
      <input type="month"  class = "form-control" name="<?= $name; ?>" <?php if($required){ echo "required"; } ?> >
    </div> <br/>
    <?php
  }

/**
*@param string Label of the field
*@param string Name of form field
*@param bool Optionnal param default : false file not required, put true if $required
*@return void
*/
  public function add_file($label, $name, $required = false) : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
    <label for =""><?= $label; ?></label><br/>
      <input type="file" name = "<?= $name; ?>"  <?php if($required){ echo "required"; } ?>>
  </div><br/>
  <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal param default : false file not required, put true if $required
  *@param string Optionnal argument Placeholder
  *@return void
  */
  public function add_number($label, $name, $required = false, $placeholder = '') : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
      <label for =""><?= $label; ?></label>
      <input type="number"  class = "form-control" name="<?= $name; ?>" placeholder="<?= $placeholder; ?>" <?php if($required){ echo "required"; } ?>  >
    </div> <br/>
    <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal param default : false file not required, put true if $required
  *@return void
  */
  public function add_password($label, $name, $required = false) : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
      <label for =""><?= $label; ?></label>
      <input type="password"  class = "form-control" name="<?= $name; ?>" <?php if($required){ echo "required"; } ?> >
    </div> <br/>
    <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal param default : false file not required, put true if $required
  *@param string Optionnal argument Placeholder
  *@return void
  */
  public function add_tel($label, $name, $required = false, $placeholder = '') : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
      <label for =""><?= $label; ?></label>
      <input type="tel"  class = "form-control" name="<?= $name; ?>" placeholder="<?= $placeholder; ?>" <?php if($required){ echo "required"; } ?> >
    </div> <br/>
    <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal param default : false file not required, put true if $required
  *@param string Optionnal argument Placeholder
  *@return void
  */
  public function add_url($label, $name, $required = false, $placeholder = '') : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
      <label for =""><?= $label; ?></label>
      <input type="url"  class = "form-control" name="<?= $name; ?>" placeholder="<?= $placeholder; ?>" <?php if($required){ echo "required"; } ?> >
    </div> <br/>
    <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal param default : false file not required, put true if $required
  *@return void
  */
  public function add_week($label, $name, $required = false) : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
      <label for =""><?= $label; ?></label>
      <input type="week"  class = "form-control" name="<?= $name; ?>" <?php if($required){ echo "required"; } ?> >
    </div> <br/>
    <?php
  }

  /**
  *@param string Label of the field
  *@param string Name of form field
  *@param bool Optionnal param default : false file not required, put true if $required
  *@return void
  */
  public function add_text($label, $name, $required = false) : void {
    $this->_data [] = $name;
    ?>
    <div class = "form-group">
      <label for =""><?= $label; ?></label>
      <input type="text"  class = "form-control" name="<?= $name; ?>" <?php if($required){ echo "required"; } ?> >
    </div> <br/>
    <?php
  }


/**
*@return void
*/
public function add_reset() : void {
  ?>
  <div class="form-group">
    <input type="reset" value="Reset" class = "btn btn-danger">
  </div>
  <br/>
  <?php
}

  /**
  *@param string Text of the submit button
  *@return void
  */
  public function add_submit($label) : void {
    ?>
     <button type="submit" id="soumettre" class = "btn btn-primary"><?= $label; ?></button>
  <!--Close the main container -->
   </div>
 </form>
     <?php
  }
}

 ?>
