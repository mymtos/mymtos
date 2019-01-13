<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once("function.mtassetfilepath.php");
function smarty_function_mtassetproperty($args, &$ctx)
{
    $asset = $ctx->stash('asset');
    if (!$asset) {
        return '';
    }
    if (!isset($args['property'])) {
        return '';
    }

    if ($args['property'] == 'file_size') {
        $asset_file = smarty_function_mtassetfilepath($args, $ctx);

        $filesize = filesize($asset_file);
        $format = '1';
        if (isset($args['format'])) {
            $format = $args['format'];
        }

        if ($format == '1') {
            if ($filesize < 1024) {
                $filesize = sprintf("%d Bytes", $filesize);
            } elseif ($filesize < 1048576) {
                $filesize = sprintf("%.1f KB", $filesize / 1024);
            } else {
                $filesize = sprintf("%.1f MB", $filesize / 1048576);
            }
        } elseif ($format == 'k') {
            $filesize = sprintf("%.1f", $filesize / 1024);
        } elseif ($format == 'm') {
            $filesize = sprintf("%.1f", $filesize / 1048576);
        }
        return $filesize;
    } elseif (($args['property'] == 'image_width') || ($args['property'] == 'image_height')) {
        if ($asset->asset_class == 'image') {
            $prop = 'asset_'.$args['property'];
            return $asset->$prop;
        } else {
            return 0;
        }
    } else {
        $prop = 'asset_'.$args['property'];
        if (is_null($asset->$prop)) {
            return '';
        }
        return $asset->$prop;
    }
}
