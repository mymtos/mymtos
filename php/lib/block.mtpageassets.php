<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once("block.mtassets.php");
function smarty_block_mtpageassets($args, $content, &$ctx, &$repeat)
{
    return smarty_block_mtassets($args, $content, $ctx, $repeat);
}
