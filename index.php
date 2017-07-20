<?php require_once('inc/loader.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?=core_output_head()?>
  </head>

  <body>

	<div class="container">
                <div class="row">
                        <div class="col-md-4">
                                <h1>MIN&Xi;</h1>
                        </div>
                        <div class="col-md-8">
                                <?php if ( $cache == '1' ) { ?><div class="alert alert-warning cache">Using Cached Data</div><?php } ?>
                        </div>
                </div>

		<?php if ( $stat['waiting'] == '1' ) {
			echo '<div class="col-md-12"><p align="center"><em>There is insufficient data to produce any useful metrics.<br>Please check your wallet settings in config.php.<br>The pool you are querying may also be limiting API requests - please try later.</em></p></div>';
			die;
		} ?>

		<div class="col-md-6">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>Statistics<span class="pull-right">ETH:<?=$fiat['code'].'['.number_format($obj['coin_to_fiat'],2)?>]</span></h4></li>
				<li class="list-group-item">
					<?php if ( $conf['show_reportedhash'] == '0' ) { ?>Mined<span class="pull-right">&Xi;<?=$stat['unpaid']?></span> <?php } ?>
					<?php if ( $conf['show_reportedhash'] == '1' ) { ?>Reported Hashrate<span class="pull-right"><?=$stat['reportedhashrate']?> MH/s</span> <?php } ?>
				</li>
				<li class="list-group-item">Effective Hashrate [60 mins]	<span class="pull-right"><?=$stat['hashrate']?></span></li>
				<li class="list-group-item">Average Hashrate [24 hrs]		<span class="pull-right"><?=$stat['avghashrate']?> MH/s</span></li>
			</ul>
		</div>

		<div class="col-md-6">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>Progr&Xi;ss
					<span class="pull-right col-xs-8 text-right" style="padding: 0;">
					<?php if ( $conf['show_bar'] == '1' ) { ?>
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-<?=$conf['colour']?> active" role="progressbar" aria-valuenow="<?=$stat['unpaid']?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=number_format(($stat['unpaid']/$stat['payout'])*100)?>%">
								<p><?=number_format(($stat['unpaid']/$stat['payout'])*100)?>%</p>
							</div>
						</div>
					<?php } else {
						echo number_format(($stat['unpaid']/$stat['payout'])*100).'%';
					} ?>
					</span>
				</h4></li>
				<li class="list-group-item">Remaining 	<span class="pull-right">&Xi;<?=number_format($stat['eneeded'],5)?></span></li>
				<li class="list-group-item">Time Left	<span class="pull-right"><?=core_calc_remaining($stat['hoursuntil'])?></span></li>
				<li class="list-group-item">Next Payout	<span class="pull-right"><?=$stat['paytime']?></span></li>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>&Xi;TH</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?>		<li class="list-group-item">Minute 	<span class="pull-right">&Xi;<?=number_format($stat['emin'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour 	<span class="pull-right">&Xi;<?=number_format($stat['ehour'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day 	<span class="pull-right">&Xi;<?=number_format($stat['eday'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week 	<span class="pull-right">&Xi;<?=number_format($stat['eweek'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month 	<span class="pull-right">&Xi;<?=number_format($stat['emonth'],5)?></span></li>	<?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>&Xi;TH &raquo; ฿TC</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?>		<li class="list-group-item">Minute 	<span class="pull-right">฿<?=number_format($stat['bmin'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour 	<span class="pull-right">฿<?=number_format($stat['bhour'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day 	<span class="pull-right">฿<?=number_format($stat['bday'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week 	<span class="pull-right">฿<?=number_format($stat['bweek'],5)?></span></li>	<?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month 	<span class="pull-right">฿<?=number_format($stat['bmonth'],5)?></span></li>	<?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>&Xi;TH &raquo; <?=$fiat['code']?></h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?>		<li class="list-group-item">Minute 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['emin']*$obj['coin_to_fiat']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['ehour']*$obj['coin_to_fiat']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['eday']*$obj['coin_to_fiat']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['eweek']*$obj['coin_to_fiat']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['emonth']*$obj['coin_to_fiat']),2)?></span></li><?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>฿TC &raquo; <?=$fiat['code']?></h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?>		<li class="list-group-item">Minute 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['bmin']*$obj['btc_to_fiat']),2)?></span></li>	<?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['bhour']*$obj['btc_to_fiat']),2)?></span></li>	<?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['bday']*$obj['btc_to_fiat']),2)?></span></li>	<?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['bweek']*$obj['btc_to_fiat']),2)?></span></li>	<?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month 	<span class="pull-right"><?=$fiat['sym'].number_format(($stat['bmonth']*$obj['btc_to_fiat']),2)?></span></li>	<?php } ?>
			</ul>
		</div>

		<?php if ( $conf['show_power'] == '1' ) { ?>
		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>Power Costs</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?><li class="list-group-item">Minute<span class="pull-right"><?=$fiat['sym'].number_format($stat['power-min'],2)?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour<span class="pull-right"><?=$fiat['sym'].number_format($stat['power-hour'],2)?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day<span class="pull-right"><?=$fiat['sym'].number_format($stat['power-day'],2)?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week<span class="pull-right"><?=$fiat['sym'].number_format($stat['power-week'],2)?></span></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month<span class="pull-right"><?=$fiat['sym'].number_format($stat['power-month'],2)?></span></li><?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>&Xi;TH Profitability</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?><li class="list-group-item">Minute<span class="pull-right"><?=$fiat['sym'].number_format((($stat['emin']*$obj['coin_to_fiat'])-$stat['power-min']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour<span class="pull-right"><?=$fiat['sym'].number_format((($stat['ehour']*$obj['coin_to_fiat'])-$stat['power-hour']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day<span class="pull-right"><?=$fiat['sym'].number_format((($stat['eday']*$obj['coin_to_fiat'])-$stat['power-day']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week<span class="pull-right"><?=$fiat['sym'].number_format((($stat['eweek']*$obj['coin_to_fiat'])-$stat['power-week']),2)?></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month<span class="pull-right"><?=$fiat['sym'].number_format((($stat['emonth']*$obj['coin_to_fiat'])-$stat['power-month']),2)?></span></li><?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>&Xi;TH buy-in</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?><li class="list-group-item">Minute<span class="pull-right"><?=$fiat['sym'].number_format(($stat['power-min']/$stat['emin']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour<span class="pull-right"><?=$fiat['sym'].number_format(($stat['power-hour']/$stat['ehour']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day<span class="pull-right"><?=$fiat['sym'].number_format(($stat['power-day']/$stat['eday']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week<span class="pull-right"><?=$fiat['sym'].number_format(($stat['power-week']/$stat['eweek']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month<span class="pull-right"><?=$fiat['sym'].number_format(($stat['power-month']/$stat['emonth']),2)?></span></li><?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>฿TC Profitability</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?><li class="list-group-item">Minute<span class="pull-right"><?=$fiat['sym'].number_format((($stat['bmin']*$obj['btc_to_fiat'])-$stat['power-min']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour<span class="pull-right"><?=$fiat['sym'].number_format((($stat['bhour']*$obj['btc_to_fiat'])-$stat['power-hour']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day<span class="pull-right"><?=$fiat['sym'].number_format((($stat['bday']*$obj['btc_to_fiat'])-$stat['power-day']),2)?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week<span class="pull-right"><?=$fiat['sym'].number_format((($stat['bweek']*$obj['btc_to_fiat'])-$stat['power-week']),2)?></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month<span class="pull-right"><?=$fiat['sym'].number_format((($stat['bmonth']*$obj['btc_to_fiat'])-$stat['power-month']),2)?></span></li><?php } ?>
			</ul>
		</div>
		<?php } ?>
	</div>

	<!-- Please leave this footer block in place, so that others can find ethermine-stats -->
	<div class="container">
		<div class="col-md-12 footer">
			<a href="https://github.com/tsumaru720/ethermine-stats" target="_blank" class="pull-right"><i class="fa fa-github"></i> ETHERMINE-STATS</a>
		</div>
	</div>
	<!-- Please leave this footer block in place, so that others can find ethermine-stats -->

	<?=core_output_footerscripts()?>

  </body>

</html>
