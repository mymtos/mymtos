<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once('block.mtparentcategories.php');
function smarty_block_mtparentfolders($args, $content, &$ctx, &$repeat)
{
    $args['class'] = 'folder';
    return smarty_block_mtparentcategories($args, $content, $ctx, $repeat);
}
