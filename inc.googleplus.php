      <li>
          <div class="count">
            <?php echo $counts->getPlusOnes($bID); ?>
          </div>
          <a <?php echo "href=\"https://plus.google.com/share?url={$counts->getCurrentUrl()}\"" ?> class="icon-google-plus" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
      </li>