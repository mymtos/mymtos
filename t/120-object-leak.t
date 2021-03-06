#!/usr/bin/perl

use strict;
use warnings;
use lib qw( t/lib lib extlib ../lib ../extlib );

BEGIN {
    $ENV{MT_CONFIG} = 'mysql-test.cfg';
}

use Test::More;

use constant HAS_LEAKTRACE => eval { require Test::LeakTrace };

BEGIN {
    if ( !HAS_LEAKTRACE ) {
        plan skip_all => 'require Test::LeakTrace';
    }
    elsif ( ( $ENV{HARNESS_PERL_SWITCHES} || '' ) =~ /-MDevel::Cover/ ) {
        plan skip_all => 'skip if coverage test';
    }
}

use Test::LeakTrace;
use MT::Test qw(:db :data);
use MT;

my $mt = MT->new();

# Clear cache
my $request = MT::Request->instance;
$request->{__stash} = {};

# Bugid:107443, Memory Leak: Reblessed objects contain cyclic ref
# this test should run with:
# DisableObjectCache 1 (already included in mysql-test.cfg)
# otherwise the cache will hold the leaked object, and it won't be seen as leak

my $tests = [

    # normal loading
    [qw{ website website 2 }],
    [qw{ blog blog 1 }],
    [qw{ entry entry 1 }],
    [qw{ page page 20 }],
    [qw{ category category 1 }],
    [qw{ folder folder 20 }],

    # reblessed loading
    [qw{ blog website 2 }],
    [qw{ website blog 1 }],
    [qw{ page entry 1 }],
    [qw{ entry page 20 }],
    [qw{ folder category 1 }],
    [qw{ category folder 20 }],
];

foreach my $rec (@$tests) {
    my ( $model, $expected, $id ) = @$rec;
    no_leaks_ok {
        $mt->model($model)->load($id);
    }
    "$model should not leak";
    my $expected_class = $mt->model($expected);
    my $obj            = $mt->model($model)->load($id);
    isnt( $obj, undef, "Object $model loaded" );
    is( ref($obj), $expected_class, "Object $model of type $expected_class" );
}

done_testing;

