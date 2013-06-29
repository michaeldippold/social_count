<li>
          <div class="count">
           <?php echo $counts->getTweetCount($bID); ?>
          </div>
          <a <?php echo "href=\"https://twitter.com/intent/tweet?url={$counts->getCurrentUrl()}&via=itsahappymedium&text={$c->getCollectionName()}\"" ?> class="icon-twitter" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
</li>