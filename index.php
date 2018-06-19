<?php require_once('inc/loader.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?=core_output_head()?>
  </head>

  <body>

	<div class="container">
                <div class="row">
                        <div class="alert alert-success" role="alert">
                                <h4>Miner: <?=$conf['wallet']?></h4>
                        </div>
                        <div class="col-md-12">
                                <?php if ( $msg['display'] == true ) { ?><div class="alert alert-<?=$msg['type']?> user_message"><?=$msg['text']?></div><?php } ?>

							<!-- Next update in <?=duration($cacheExpiry)?> -->
                        </div>
                </div>

		<?php if ( $obj['success'] == false ) {
			echo '<div class="col-md-12"><p align="center"><em>There is no data currently cached to display</em></p></div>';
			die;
		} ?>
		
		

		<div class="col-md-4">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>Balance<span class="pull-right"><?=number_format($obj['balance'],5)?> ETH</span></h4></li>
				<li class="list-group-item">
					<?php if ( $conf['show_reportedhash'] == '0' ) { ?>Mined<span class="pull-right"><?=$stat['unpaid'].' ETH'?></span> <?php } ?>
					<?php if ( $conf['show_reportedhash'] == '1' ) { ?>Fiat Balance<span class="pull-right"><?=number_format($obj['coin_to_fiat']*$obj['balance'],2).' '.$fiat['code']?></span> <?php } ?>
				</li>
				<li class="list-group-item">Fiat Balance	<span class="pull-right"><?=number_format($obj['eth_to_usd']*$obj['balance'],2)?> $</span></li>
				<li class="list-group-item">Last tx		<span class="pull-right"><?=$stat['lastouttx']?></span></li>
			</ul>
		</div>
		
				<div class="col-md-4">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>Statistics<span class="pull-right">ETH Price: <?=number_format($obj['eth_to_usd'],2).' $'?></span></h4></li>
				<li class="list-group-item">
					<?php if ( $conf['show_reportedhash'] == '0' ) { ?>Mined<span class="pull-right"><?=$stat['unpaid'].' ETH'?></span> <?php } ?>
					<?php if ( $conf['show_reportedhash'] == '1' ) { ?>Reported Hashrate<span class="pull-right"><?=$stat['reportedhashrate']?> MH/s</span> <?php } ?>
				</li>
				<li class="list-group-item">Effective Hashrate [60 mins]	<span class="pull-right"><?=$stat['hashrate']?> MH/s</span></li>
				<li class="list-group-item">Average Hashrate [24 hrs]		<span class="pull-right"><?=$stat['avghashrate']?> MH/s</span></li>
			</ul>
		</div>
		

		<div class="col-md-4">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>Progress
					<span class="pull-right col-xs-8 text-right" style="padding: 0;">
					<?php if ( $conf['show_bar'] == '1' ) { ?>
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-<?=$conf['colour']?> active" role="progressbar" aria-valuenow="<?=$stat['unpaid']?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=floor(($stat['unpaid']/$stat['payout'])*100)?>%">
								<p><?=floor(($stat['unpaid']/$stat['payout'])*100)?>%</p>
							</div>
						</div>
					<?php } else {
						echo floor(($stat['unpaid']/$stat['payout'])*100).'%';
					} ?>
					</span>
				</h4></li>
				<li class="list-group-item">Remaining 	<span class="pull-right"><?=number_format($stat['eneeded'],5).' ETH'?></span></li>
				<li class="list-group-item">Time Left	<span class="pull-right"><?=core_calc_remaining($stat['hoursuntil'])?></span></li>
				<li class="list-group-item">Next Payout	<span class="pull-right"><?=$stat['paytime']?></span></li>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>ETH</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?>		<li class="list-group-item">Minute 	<span class="pull-right"><?=number_format($stat['emin'],5).' ETH'?></span></li>	<?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour 	<span class="pull-right"><?=number_format($stat['ehour'],5).' ETH'?></span></li>	<?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day 	<span class="pull-right"><?=number_format($stat['eday'],5).' ETH'?></span></li>	<?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week 	<span class="pull-right"><?=number_format($stat['eweek'],5).' ETH'?></span></li>	<?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month 	<span class="pull-right"><?=number_format($stat['emonth'],5).' ETH'?></span></li>	<?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>ETH &raquo; <?=$fiat['code']?></h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?>		<li class="list-group-item">Minute 	<span class="pull-right"><?=number_format(($stat['emin']*$obj['coin_to_fiat']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour 	<span class="pull-right"><?=number_format(($stat['ehour']*$obj['coin_to_fiat']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day 	<span class="pull-right"><?=number_format(($stat['eday']*$obj['coin_to_fiat']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week 	<span class="pull-right"><?=number_format(($stat['eweek']*$obj['coin_to_fiat']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month 	<span class="pull-right"><?=number_format(($stat['emonth']*$obj['coin_to_fiat']),2).$fiat['sym']?></span></li><?php } ?>
			</ul>
		</div>

		
		<?php if ( $conf['show_power'] == '1' ) { ?>
		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>Power Costs</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?><li class="list-group-item">Minute<span class="pull-right"><?=number_format($stat['power-min'],2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour<span class="pull-right"><?=number_format($stat['power-hour'],2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day<span class="pull-right"><?=number_format($stat['power-day'],2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week<span class="pull-right"><?=number_format($stat['power-week'],2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month<span class="pull-right"><?=number_format($stat['power-month'],2).$fiat['sym']?></span></li><?php } ?>
			</ul>
		</div>

		<div class="col-md-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-<?=$conf['colour']?>"><h4>ETH Profitability</h4></li>
				<?php if ( $conf['show_min'] == '1' ) { ?><li class="list-group-item">Minute<span class="pull-right"><?=number_format((($stat['emin']*$obj['coin_to_fiat'])-$stat['power-min']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_hour'] == '1' ) { ?>	<li class="list-group-item">Hour<span class="pull-right"><?=number_format((($stat['ehour']*$obj['coin_to_fiat'])-$stat['power-hour']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_day'] == '1' ) { ?>		<li class="list-group-item">Day<span class="pull-right"><?=number_format((($stat['eday']*$obj['coin_to_fiat'])-$stat['power-day']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_week'] == '1' ) { ?>	<li class="list-group-item">Week<span class="pull-right"><?=number_format((($stat['eweek']*$obj['coin_to_fiat'])-$stat['power-week']),2).$fiat['sym']?></span></li><?php } ?>
				<?php if ( $conf['show_month'] == '1' ) { ?>	<li class="list-group-item">Month<span class="pull-right"><?=number_format((($stat['emonth']*$obj['coin_to_fiat'])-$stat['power-month']),2).$fiat['sym']?></span></li><?php } ?>
			</ul>
		</div>


		<?php } ?>
            
            
            
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table panel panel-success table-striped table-hover">
                    <thead class="panel-heading">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Worker (<?=$stat['activeworkers']?>)</th>
                            <th class="text-center">Current Hashrate</th>
                            <th class="text-center">Reported Hashrate</th>
                            <th class="text-center">Average Hashrate</th>
                            <th class="text-center">Valid Shares</th>
                            <th class="text-center">Stale Shares</th>
                            <th class="text-center">Last Seen</th>
                        </tr>
                    </thead>
                    <tbody class="panel-body text-center">
                    <?php
                        $x = 1;
                        foreach ($obj['workers'] as $key => $worker){
                        if ($worker['lastSeen'] == null){
                             echo '<tr class="bg-danger"><td>'.$x.'</td><td>'.$worker['worker'].'</td><td colspan="6">Offline</td></tr>';
                        } else {
                        $worker['currentHashrate'] /= 1000000; 
                        $worker['reportedHashrate'] /= 1000000;
                        $worker['averageHashrate'] /= 1000000;
                        $worker['lastSeen'] = (time())-($worker['lastSeen']);
                        $worker['lastSeen'] = duration($worker['lastSeen']);
                        echo '<tr><td>'.$x.'</td>
                                <td>'.$worker['worker'].'</td>
                                <td>'.number_format($worker['currentHashrate'],2).' MH/s</td>
                                <td>'.number_format($worker['reportedHashrate'],2).' MH/s</td>
                                <td>'.number_format($worker['averageHashrate'],2).' MH/s</td>
                                <td>'.$worker['validShares'].'</td>
                                <td>'.$worker['staleShares'].'</td>
                                <td>'.$worker['lastSeen'].'</td></tr>';
                                }
                                $x += 1;
                        }
                    ?>    
                    </tbody>
                </table>
            </div>
        </div>
								
			
	</div>

	<!-- Please leave this footer block in place, so that others can find ethermine-stats -->
	<div class="container">
            <div class="col-md-12 footer">
			<a href="https://github.com/jooni22/ethermine-stats" target="_blank" class="pull-right"><i class="fa fa-github"></i> ETHERMINE-STATS</a>
		</div>
	</div>
	<!-- Please leave this footer block in place, so that others can find ethermine-stats -->

	<?=core_output_footerscripts()?>

  </body>

</html>
