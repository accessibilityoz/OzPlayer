<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<style type="text/css">
	<!--

	html, body { background:#fafaef; color:#444; font:normal normal normal 100%/1.3 tahoma,sans-serif; }
	body { font-size:88.8%; padding:12px 15px; }
	h1, h2 { color:#520; margin:0 0 10px 0; font:normal normal normal 2.2em/1.3 arial,sans-serif; letter-spacing:-0.05em; }
	h2 { color:#750; font-size:1.4em; margin:25px 0 7px 0; }
	h3 { margin:-4.2em 0 0 0; float:right; position:fixed; bottom:5px; right:10px; padding:2px 5px; color:#555; background:#fafaef; text-shadow:1px 1px 0 rgba(60,50,30,0.2); font:normal normal normal 0.83em arial,sans-serif; }
	fieldset { padding:0; border:none; }
	textarea { font:normal normal normal 0.85em/1.35 monaco,"courier new",monospace; border:2px ridge #ca6; background:#ffd; color:#333; width:66%; height:36em; padding:10px; margin:0 0 15px 15px; }
	table { width:0%; min-width:20em; border:2px ridge #ca6; border-collapse:collapse; background:#ffd; color:#333; margin:0 0 15px 15px; font:normal normal normal 0.9em/1.1 arial,sans-serif; }
	th, td, caption { white-space:nowrap; text-align:center; vertical-align:top; padding:4px 8px; border-color:#ca6; }
	th:first-child, td:first-child, caption { text-align:left; padding-right:24px; }
	caption { color:#520; font-family:tahoma,sans-serif; font-size:1.1em; padding:0 0 8px 4px; }
	caption code { letter-spacing:-0.05em; color:inherit; }
	th { background:#fd9; border-bottom:1px solid #ca6; font-weight:bold; font-size:1.1em; color:#431; text-shadow:-1px -1px 0 rgba(255,240,200,0.7); }
	td, tbody th { padding:3px 8px; }
	tbody tr:first-child > * { padding-top:5px; }
	tbody tr:last-child > * { padding-bottom:6px; }
	tr em { color:#986; font:italic normal normal 0.83em arial,sans-serif; }
	tr var { font-style:normal; }
	tr samp { color:#000; font:normal normal normal 0.9em monospace; }
	tr abbr { border:none; font-style:normal; font-size:0.78em; padding-left:0.1em; }

	-->
	</style>


	<!-- Live example (see CSS console for faults) -->
	<style type="text/css">
	<!--

	<?php include_once("css_compressor.php"); ?>


	-->
	</style>

	<title>Results of compression for "<?php echo $cssfile; ?>"</title>

</head>

<body>


	<h1>Results of compression </h1>

	<h3><code><?php echo date("H:i:s"); ?></code></h3>


	<table id="overall" cellpadding="0" cellspacing="0" border="1"
		summary="This table has two columns for each row, showing the description and data for each statistic.">
		<caption><code>"<?php echo $cssfile; ?>"</code></caption>
		<tbody>
			<tr>
				<th id="overall-input">Input size</th>
				<td headers="overall-input"><code><?php echo number_format(round(($overall_compression['before'] / 1024), 2), 2); ?><abbr title="Kilobytes (<?php echo(number_format($overall_compression['before'])); ?> bytes)">K</abbr></code></td>
			</tr>
			<tr>
				<th id="overall-output">Output size</th>
				<td headers="overall-output"><code><?php echo number_format(round(($overall_compression['after'] / 1024), 2), 2); ?><abbr title="Kilobytes (<?php echo(number_format($overall_compression['after'])); ?> bytes)">K</abbr></code></td>
			</tr>
			<tr>
				<th id="overall-compressed">Output %</th>
				<td headers="overall-compressed"><code><?php echo number_format(round((($overall_compression['after'] / $overall_compression['before']) * 100), 3), 2); ?><abbr title="Percent of input size">%</abbr></code></td>
			</tr>
			<tr>
				<th id="overall-compression">Compression ratio</th>
				<td headers="overall-compression" title="<?php

				$multiplier = 1;
				$factor = ($overall_compression['before'] / $overall_compression['after']);

				$decimal = ($factor - floor($factor));
				$rounder = $decimal;
				while(round($rounder, 2) != round($rounder, 0))
				{
					$rounder += $decimal;
					$multiplier ++;
				}

				echo round($factor * $multiplier) . ':' . $multiplier;

				?>"><code><?php

				echo round($overall_compression['before'] / $overall_compression['after'], 2) . ':1';

				?></code></td>
			</tr>
		</tbody>
	</table>





	<h2>Compression details</h2>


	<table id="extra" cellpadding="0" cellspacing="0" border="1"
		summary="This table has two columns for each row, showing the type of information removed, and the amount.">
		<caption>Extraneous information removed</caption>
		<thead>
			<tr>
				<th id="extra-type">Type</th>
				<th id="extra-amount">Amount removed</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td headers="extra-type">Comments</td>
				<td headers="extra-amount"><code><?php echo number_format(round(($extra_compression['comments'] / 1024), 2), 2); ?><abbr title="Kilobytes (<?php echo(number_format($extra_compression['comments'])); ?> bytes)">K</abbr></code></td>
			</tr>
			<tr>
				<td headers="extra-type">Whitespace</td>
				<td headers="extra-amount"><code><?php echo number_format(round(($extra_compression['whitespace'] / 1024), 2), 2); ?><abbr title="Kilobytes (<?php echo(number_format($extra_compression['whitespace'])); ?> bytes)">K</abbr></code></td>
			</tr>
			<tr>
				<td headers="extra-type">Debug sections</td>
				<td headers="extra-amount"><code><?php echo number_format(round(($extra_compression['debug'] / 1024), 2), 2); ?><abbr title="Kilobytes (<?php echo(number_format($extra_compression['debug'])); ?> bytes)">K</abbr></code></td>
			</tr>
		</tbody>
	</table>





	<h2>Compressed code</h2>


	<form id="code" action="#">
		<fieldset>
			<textarea id="csscode" rows="15" cols="75" spellcheck="false" onfocus="try { this.select(); } catch(ex){}"><?php echo htmlspecialchars($css); ?></textarea>
		</fieldset>
	</form>


</body>
</html>
