<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once('rating_lib.php');

function smarty_function_mtassetscore($args, &$ctx)
{
    return hdlr_score($ctx, 'asset', $args['namespace'], $args['default'], $args);
}
