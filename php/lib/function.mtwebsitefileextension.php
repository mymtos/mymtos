<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtwebsitefileextension($args, &$ctx)
{
    // status: complete
    // parameters: none
    require_once('function.mtblogfileextension.php');
    return smarty_function_mtblogfileextension($args, $ctx);
}
