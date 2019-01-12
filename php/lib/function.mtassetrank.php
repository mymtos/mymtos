<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once('rating_lib.php');

function smarty_function_mtassetrank($args, &$ctx)
{
    return hdlr_rank(
        $ctx,
        'asset',
        $args['namespace'],
        $args['max'],
        "",
        $args
    );
}
