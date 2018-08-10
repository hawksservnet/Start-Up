			<div id="breadcrumb">
				<ul class="clearfix">
					<li><a href="<?= Uri::create(''.$parent_link.''); ?>"><?php echo $parent_title; ?></a></li>
					<?php if(!empty($child_title)): ?>
					<li><a href="<?= Uri::create(''.$child_link.''); ?>"><?php echo $child_title; ?></a></li>
					<?php endif; ?>
					<li><span><?php echo $page_title; ?></span></li>
				</ul>
			</div>