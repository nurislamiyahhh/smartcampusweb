                 <?php
                    include "config.php";
                    //baca isi tabel tmprfid
                    $sql = mysqli_query($conn, "SELECT * FROM tmprfid");
                    $data = mysqli_fetch_array($sql);
                    //baca nokartu
                    $no_id = $data['no_id'] ?? null;
                ?>

                <div class="form-group">
                    <label>No.Kartu</label>
                    <input type="text" name="no_id" id="no_id" placeholder="Tempelkan Kartu RFID Anda" class="form-control" value="<?php echo $no_id; ?>">
                </div>