<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once('block.mtentriesheader.php');
function smarty_block_mtpagesheader($args, $content, &$ctx, &$repeat)
{
    return smarty_block_mtentriesheader($args, $content, $ctx, $repeat);
}
