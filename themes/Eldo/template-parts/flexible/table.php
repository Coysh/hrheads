<div class="inner-section table-layout">
  <div class="container">
    <div class="row">

	    <div class="col-12 table-wrap">
		    <?php
		    $table = get_sub_field( 'table' );

if ( ! empty ( $table ) ) {

    echo '<table border="0">';

        if ( ! empty( $table['caption'] ) ) {

            echo '<caption>' . $table['caption'] . '</caption>';
        }

        if ( ! empty( $table['header'] ) ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                        echo nl2br( $td['c'] );
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>'; 
} ?>
	    </div>
    </div>
  </div>
</div>
