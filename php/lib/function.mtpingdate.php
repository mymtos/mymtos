<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtpingdate($args, &$ctx) {
    $p = $ctx->stash('ping');
    $args['ts'] = $p->tbping_created_on;
    return $ctx->_hdlr_date($args, $ctx);
}
?>
