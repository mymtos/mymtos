# Copyright (C) 2001-2013 Six Apart, Ltd.
# Copyright (C) 2018 Masahiro IUCHI
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

package MT::ObjectDriver::Driver::CacheWrapper;

use strict;
use MT;

my $CACHE_ENABLED;

sub wrap {
    my $class = shift;
    my ( $fallback, $object_class ) = @_;

    # prevent caching if so configured
    unless ( defined $CACHE_ENABLED ) {
        $CACHE_ENABLED = MT->config->DisableObjectCache ? 0 : 1;
    }
    my $use_caching = 1;
    if ( $CACHE_ENABLED && $object_class ) {
        if ( my $props = $object_class->properties ) {
            $use_caching = 0
                if ( defined $props->{cacheable} )
                && ( !$props->{cacheable} );
        }
    }
    elsif ( !$CACHE_ENABLED ) {
        $use_caching = 0;
    }

    if ($use_caching) {
        ## If running under mod_perl, using request->pnotes; otherwise,
        ## just use a hash.
        my $ram_cache;
        if ( $ENV{MOD_PERL} ) {
            require Data::ObjectDriver::Driver::Cache::Apache;
            $ram_cache = 'Data::ObjectDriver::Driver::Cache::Apache';
        }
        else {
            require MT::ObjectDriver::Driver::Cache::RAM;
            $ram_cache = 'MT::ObjectDriver::Driver::Cache::RAM';
        }

        return sub {
            return $ram_cache->new( fallback => $fallback->(), );
        };
    }
    else {
        return $fallback;
    }
}

1;
