<?php
$url = (strpos($_SERVER["HTTP_HOST"],'dev-mp') === false)?"https://startuphub.tokyo/":"https://dev.startuphub.tokyo/" ;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php //echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::css('bootstrap-datetimepicker.min.css'); ?>
	<?php echo Asset::css('non-responsive.css'); ?>
	<?php echo Asset::css('admin.css'); ?>
	<?php if (!empty($extra_css)) echo Asset::css($extra_css); ?>
	<?php //echo Asset::css('bootstrap-responsive.css'); ?>
	<style>
		body { margin: 50px; }
	</style>
	<?php echo Asset::js(array(
		'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
		'bootstrap.js',
		'moment-with-locales.js',
		'bootstrap-datetimepicker.min.js'
	)); ?>
	<script>
		// $(function(){ $('.topbar').dropdown(); });
	</script>
</head>
<body>
	<?php echo Asset::render('extra_css');?>
    <?php echo Asset::render('add_js');?>
	<?php if (isset($current_user)): ?>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo Uri::create("admin"); ?>">startup hub管理画面</a>

			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">

					<!-- <li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
						<?php echo Html::anchor('admin', 'Dashboard') ?>
					</li> -->

					<?php
						$files = new GlobIterator(APPPATH.'classes/controller/admin/*.php');
						foreach($files as $file) {
                            $section_segment = $file->getBasename('.php');
                            $section_title = Inflector::humanize($section_segment);
                            $permissionList = array(
                                'events' => array(0, 1, 2, 5),
                                'category' => array(0, 1),
                                'tag' => array(0, 1),
                                'users' => array(0, 1, 5),
                            );
                            if (in_array($current_user->authority, $permissionList[$section_segment])) {
                                ?>
                                <li class="<?php echo Uri::segment(2) == $section_segment ? 'active' : '' ?>">
                                    <?php echo Html::anchor('admin/' . $section_segment, $section_title) ?>
                                </li>
                                <?php
                            }
                        }
					?>
                    <?php if ($current_user->authority == 0 or ($current_user->authority == 1) or ($current_user->authority == 5)){ ?>
					<li class="<?php echo Uri::segment(3) == 'requests' ? 'active' : '' ?>">
						<?php echo Html::anchor('admin/preentre/requests', 'PreentreRequests') ?>
					</li>
                    <?php }?>
					<?php if ($current_user->authority == 0){ ?>
					<li class="">
						<?php echo Html::anchor($url . 'management/account/', 'Account') ?>
					</li>
					<?php }?>
					<?php if (($current_user->authority == 0) or ($current_user->authority == 1) or ($current_user->authority == 5)){ ?>
					<li class="">
						<?php echo Html::anchor($url . 'management/schedule/week', 'Concierge') ?>
					</li>
                    <li class="">
                        <?php echo Html::anchor($url . 'management/nursery/reserve', 'KidsroomRequest') ?>
                    </li>
					<?php }?>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $current_user->account_name ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo Html::anchor('admin/logout', 'Logout') ?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?php //echo $title; ?></h1>
				<hr>
<?php if (Session::get_flash('success')): ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
					</p>
				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
					</p>
				</div>
<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
<?php echo $content; ?>
			</div>
		</div>
		<hr/>
	</div>
    <script>
        $(document).ready(function () {
            callCake();
        });

        function callCake() {
            $.ajax({
                url: '<?=$url. 'management/keep-session'?>',
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                },
            });
        }
    </script>
</body>
</html>
