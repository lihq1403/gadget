<?php

class Custom_Reflection_Function extends ReflectionFunction {

    public function getSource() {
        if( !file_exists( $this->getFileName() ) ) return false;

        $start_offset = ( $this->getStartLine() - 1 );
        $end_offset   = ( $this->getEndLine() - $this->getStartLine() ) + 1;

        return join( '', array_slice( file( $this->getFileName() ), $start_offset, $end_offset ) );
    }
}

function test()
{
    return 'hello';
}


var_dump((new Custom_Reflection_Function('test')));