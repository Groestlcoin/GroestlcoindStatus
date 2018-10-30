<div class="col-lg-12">
	<h4>Node</h4>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr><th>Node software</th><td><?=$this->info->network->subversion?></td></tr>
			<tr><th>Groestlcoin / Protocol version</th><td><?=$this->info->version?> / <?=$this->info->protocolversion?></td></tr>
			<tr><th>Uptime</th><td>xx</td></tr>
			<tr><th>Disk usage</th><td>xx (xx free)</td></tr>
			<tr><th>Memory usage</th><td>xx (xx free)</td></tr>
		</table>
	</div>

	<h4>Network</h4>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr><th>Connections</th><td><?=$this->info->connections?></td></tr>
			<?foreach ($this->info->network->networks as $network):?>
				<tr><th><?=$network->name?></th><td><?=$network->reachable?'true':'false'?></td></tr>
			<?endforeach?>
		</table>
	</div>

	<h4>Memory pool</h4>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr><th># Transactions</th><td><?=$this->info->mempool->size?></td></tr>
			<tr><th>Size</th><td><?=GroestlcoindStatus::binaryPrefix($this->info->mempool->usage)?> (max <?=GroestlcoindStatus::binaryPrefix($this->info->mempool->maxmempool)?>)</td></tr>
		</table>
	</div>

	<h4>Peers</h4>
	<div class="table-responsive">
		<table class="table table-striped" id="peers">
			<thead>
				<tr>
					<th>Country</th>
					<th>Address</th>
					<th>Ping</th>
					<th>Height</th>
					<th>Version</th>
					<th>Bytes send/received</th>
				</tr>
			</thead>
			<?foreach($this->peers as $peer):?>
			<?$geo = $this->geoIp->get(substr($peer->addr, 0, strrpos($peer->addr, ':')))?>
				<tr>
					<td title="<?=$geo['country']['names']['en']?>"><?=$geo['country']['iso_code']?></td>
					<td><?=$peer->addr?></td>
					<td><?=round(100*$peer->minping)?> (+/- <?=100*($peer->pingtime-$peer->minping)?>)</td>
					<td><?=$peer->synced_blocks-$this->info->blocks?></td>
					<td><?=trim($peer->subver, '/')?></td>
					<td><?=GroestlcoindStatus::binaryPrefix($peer->bytessent)?>/<?=GroestlcoindStatus::binaryPrefix($peer->bytesrecv)?></td>
				</tr>
			<?endforeach;?>
		</table>
	</div>
</div>
