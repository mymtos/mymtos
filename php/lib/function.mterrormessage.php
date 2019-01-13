<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mterrormessage($args, &$ctx)
{
    // status: complete
    // parameters: none
    $err = $ctx->stash('error_message');
    return empty($err) ? '' : $err;
}
