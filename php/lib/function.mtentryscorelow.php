<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once('rating_lib.php');

function smarty_function_mtentryscorelow($args, &$ctx) {
    return hdlr_score_low($ctx, 'entry', $args['namespace'], $args);
}
?>
