<?php

/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);

foreach ($brand as $row){ 
    ?>
    <a href="/<?php echo $this->urlAlias; ?>/<?php echo $row->id_brand; ?>/" title="<?php echo $row->name; ?>"><?php echo CHtml::image('/'.$row->image->file_path, $row->name);
    ?></a>
<?php      
} 

/*
echo '<br>$this->uniqueId = '.$this->uniqueId.'<br>';
echo '$this->action->id = '.$this->action->id.'<br>';
echo '$this->module->id = '.$this->module->id.'<br>';
echo 'get_class($this) = '.get_class($this).'<br>';
*/

?>