<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_block_mtdatefooter($args, $content, &$ctx, &$repeat)
{
    if (!isset($content)) {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat, 'DateFooter');
    } else {
        return $ctx->_hdlr_if($args, $content, $ctx, $repeat);
    }
}
