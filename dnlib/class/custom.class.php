<?php

class Custom
{
  public function chekinp($data)
  {
    foreach ($data as $index => $value) {
      if (!$value) {
        return false;
      } else {
        return true;
      }
    }
  }

  public function sweeterror($msg)
  {
    echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'error',
    title: '$msg'
  })</script>";
    return true;
  }

  public function sweetsuccess($msg, $greet='Congratulations!')
  {
    echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>Swal.fire(
            '$greet',
            '$msg',
            'success'
          )</script>";
    return true;
  }
}
