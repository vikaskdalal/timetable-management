<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Timetable Management System';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('bootstrap/css/bootstrap.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?php 
    echo $this->Html->script([
    		'jquery',
    		'bootstrap/js/bootstrap.min.js'
    		
    ]);
    ?>
</head>
<body>
    <?= $this->element('header'); ?>	
    <?= $this->Flash->render() ?>
    <div class="container-fluid clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
<script>
	var csrfToken = '<?= json_encode($this->request->getParam('_csrfToken')); ?>';
	csrfToken = csrfToken.replace(/"([^"]+(?="))"/g, '$1');
</script>
</body>
</html>
