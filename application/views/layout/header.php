<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $this->document->title; ?></title>
    <meta name="keyword" content="<?php echo $this->document->keyword; ?>">
    <meta name="description" content="<?php echo $this->document->description; ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <?php if (!empty($this->document->getCSS())) : ?>
        <?php foreach ($this->document->getCSS() as $css) : ?>
            <link href="<?php echo $css; ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($this->template->getCSS())) : ?>
        <?php foreach ($this->template->getCSS() as $css) : ?>
            <link href="<?php echo $css; ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
    $container = '';
    if (!empty($this->template->container)) {
        foreach ($this->template->container as $attrName => $attrValue) {
            $container .= ' '.$attrName.'="'.$attrValue.'"';
        }
    }
?>
<div <?php echo $container; ?>>

