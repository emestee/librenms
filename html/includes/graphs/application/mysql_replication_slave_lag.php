<?php

$scale_min = 0;

require 'includes/graphs/common.inc.php';

$apache_rrd = rrd_name($device['hostname'], array('app', 'mysql', $app['app_id']));

if (rrdtool_check_rrd_exists($apache_rrd)) {
    $rrd_filename = $apache_rrd;
}

$ds = 'SSBM';

$colour_area = 'CDEB8B';
$colour_line = '006600';

$colour_area_max = 'FFEE99';

$graph_max  = 1;
// $multiplier = 8;
$descr = "Slave replication lag";
$unit_text = 'sec';

require 'includes/graphs/generic_simplex.inc.php';
