<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once('block.mtcategorynext.php');
function smarty_block_mtfoldernext($args, $content, &$ctx, &$repeat) {
    $args['class'] = 'folder';
    return smarty_block_mtcategorynext($args, $content, $ctx, $repeat);
}
?>
