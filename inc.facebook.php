      <li>
          <div class="count">
            <?php echo $counts->getLikeCount($page->getCollectionID()); ?>
          </div>
          <a <?php echo "href=\"http://www.facebook.com/sharer.php?u={$counts->getCurrentUrl()}\"" ?> class="icon-facebook" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
      </li>