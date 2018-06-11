<?php
/*******************************************************************************
 Copyright (c) 2013-8 AccessibilityOz        http://www.accessibilityoz.com.au/
 ------------------------------------------------------------------------------
 OzPlayer [3.5] => player core
 ------------------------------------------------------------------------------
*******************************************************************************/
class OzPlayer
{
    private static $config = array
    (
        'transcript-cue-id'     => 'T-'
    );
    private static $lang = array
    (
        'transcript-error'      => 'Transcript is not available [%status].',
        'transcript-warning'    => 'OzPlayer Warning - PHP transcript is not available [%status].',
        'transcript-end'        => 'END OF TRANSCRIPT.',
    );
    public static function get_transcript($captions = null, $transcript = null)
    {
        if(empty($captions))
        {
            echo(self::get_error('412'));
            return;
        }
        $captions = array
        (
            'lang'    => trim((string)array_shift(array_keys($captions))),
            'vtt'     => trim((string)array_shift(array_values($captions)))
        );
        if(!file_exists($captions['vtt']))
        {
            echo(self::get_error('404'));
            return;
        }
        if(!($captions['vtt'] = file_get_contents($captions['vtt'])))
        {
            echo(self::get_error('415'));
            return;
        }
        if(!empty($transcript))
        {
            $transcript = array
            (
                'lang'    => trim((string)array_shift(array_keys($transcript))),
                'vtt'     => trim((string)array_shift(array_values($transcript)))
            );
            if(!($transcript['vtt'] = @file_get_contents($transcript['vtt'])))
            {
                $transcript = null;
            }
        }
        if(!($captions = self::parse_vtt($captions['vtt'], null, 'captions', $captions['lang'])))
        {
            echo(self::get_error('415'));
            return;
        }
        if($transcript)
        {
            if(!($transcript = self::parse_vtt($transcript['vtt'], self::$config['transcript-cue-id'], 'transcript', $transcript['lang'])))
            {
                $transcript = null;
            }
        }
        if($transcript)
        {
            $captions = array_merge($captions, $transcript);

            $timestamps = array();
            foreach($captions as $cue)
            {
                $timestamps[] = $cue['timestamp'];
            }
            array_multisort($timestamps, $captions);

            $transcript = null;
        }
        echo "\n";
        foreach($captions as $cue)
        {
            echo self::get_cue_html($cue) . "\n";
        }
        echo '<p>' . self::$lang['transcript-end'] . '</p>' . "\n\n";
    }
    private static function parse_vtt($data, $idx, $kind, $lang)
    {
        $cues = array();
        foreach(preg_split('/^[\s]*$/m', trim(preg_replace('/(\r[\n\f]?)/', "\n", $data))) as $vtt)
        {
            if(preg_match('/^\s*(WEBVTT|NOTE)/', $vtt))
            {
                continue;
            }
            $cue = array();
            $lines = self::array_string_clean(preg_split('/\s*^\s*/m', trim($vtt)));
            if(empty($lines))
            {
                continue;
            }
            if(strpos($lines[0], '-->') === false)
            {
                $cue['id'] = preg_replace('/^([\S]+).*/', '\1', trim(array_shift($lines)));
            }
            if(empty($lines) || strpos($lines[0], '-->') === false)
            {
                continue;
            }
            if(!isset($cue['id']))
            {
                $cue['id'] = (string)(count($cues) + 1);
            }
            if(!empty($idx))
            {
                $cue['id'] = "$idx$cue[id]";
            }
            $cue['kind'] = $kind;
            $cue['lang'] = $lang;
            if(!preg_match(
                '/((?:[\d]+[\:\.\,]?){3,4})(?:\s+\-\->\s+)((?:[\d]+[\:\.\,]?){3,4})/',
                array_shift($lines),
                $timestamps
                ))
            {
                continue;
            }
            $cue['timestamp'] = $timestamps[1];
            if($lines = trim(implode("\n", $lines)))
            {
                $cue['text'] = $lines;
                if(preg_match('/<a/i', $cue['text']))
                {
                    $cue['text'] = preg_replace('/(<a)/i', '\1 target="_blank"', preg_replace('/target=\"[^\"]+\"/i', '', $cue['text']));
                }
            }
            else
            {
                continue;
            }
            $cues[] = $cue;
        }
        return $cues;
    }
    private static function get_cue_html($cue)
    {
        $html = '<div'
                . ' data-kind="' . $cue['kind']
                . '" lang="' . $cue['lang']
                . '" data-cue="' . $cue['id']
                . '">';
        foreach(preg_split('/\n/', $cue['text']) as $i => $line)
        {
            preg_match('/^(?:<v(?:\s+([^>]+))?>)?(.*)$/m', $line, $parts);
            $parts[2] = preg_replace('/<\/v>/', '', trim($parts[2]));
            if(($parts[1] = trim($parts[1])) != '')
            {
                $parts[2] = preg_replace('/^[-]\s*/', '', $parts[2]);
            }
            $line = '<p' . (!empty($parts[1]) ? (' data-voice="' . $parts[1] . '"') : '') . '>'
                    . (!empty($parts[1]) ? ("<cite>$parts[1]</cite>: ") : '')
                    . ($cue['kind'] == 'captions' ? '<q>' : '')
                    . $parts[2]
                    . ($cue['kind'] == 'captions' ? '</q>' : '')
                    . '</p>';
            $line = preg_replace('/<\/c>/', '</span>', preg_replace('/<c\.([^>]+)>/', '<span class="\\1">', $line));
            $html .= $line;
        }
        return $html . '</div>';
    }
    private static function get_error($status)
    {
        return "\n"
             . '<p><strong><em>'
             . str_replace('%status', $status, self::$lang['transcript-error'])
             . '</em></strong></p>'
             . "\n"
             . '<script type="text/javascript">try { console.warn(\''
             . str_replace('%status', $status, self::$lang['transcript-warning'])
             . '\'); }catch(ex){}</script>'
             . "\n\n";
    }
    private static function array_string_clean($data)
    {
        for($i = 0; $i < count($data); $i ++)
        {
            if(($data[$i] = trim($data[$i])) == '')
            {
                array_splice($data, $i, 1);
                $i --;
            }
        }
        return $data;
    }
}
?>
