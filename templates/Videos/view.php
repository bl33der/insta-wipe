<div class="row" style="font-family: Arial, sans-serif; color: #333;">
    <aside class="column" style="width: 20%; padding: 1rem;">
        <div class="side-nav" style="background-color: #ffffff; border-radius: 8px; padding: 1rem;">
            <h4 class="heading" style=" border-bottom: 1px solid #ccc; padding-bottom: 0.5rem;"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Video'), ['action' => 'edit', $video->id], ['class' => 'side-nav-item', 'style' => 'display: block; margin: 0.5rem 0; color: #007BFF; text-decoration: none;']) ?>
            <?= $this->Form->postLink(__('Delete Video'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->id), 'class' => 'side-nav-item', 'style' => 'display: block; margin: 0.5rem 0; color: #DC3545; text-decoration: none;']) ?>
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column column-80" style="width: 80%; padding: 1rem;">
        <div class="videos view content" style="background-color: #ffffff; padding: 2rem; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); ">
            <h3 style="margin-bottom: 1.5rem;"><?= h($video->id) ?></h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
                <tr>
                    <th style="text-align: left; padding: 0.5rem; border-bottom: 1px solid #ccc; width: 20%;"><?= __('Created') ?></th>
                    <td style="padding: 0.5rem;"><?= h($video->created) ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 0.5rem; border-bottom: 1px solid #ccc;"><?= __('Modified') ?></th>
                    <td style="padding: 0.5rem;"><?= h($video->modified) ?></td>
                </tr>
            </table>

            <div class="text">
                <strong style="font-size: 1.1rem;"><?= __('Video') ?></strong><br><br>

                <?php
                preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->embed, $matches);
                $videoID = isset($matches[1]) ? $matches[1] : '';
                ?>

                <?php if ($videoID): ?>
                    <div style="max-width: 800px; border-radius: 8px; overflow: hidden; box-shadow: 0 0 8px rgba(0,0,0,0.2);">
                        <iframe width="100%" height="450"
                                src="https://www.youtube.com/embed/<?= h($videoID) ?>"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                <?php else: ?>
                    <p style="color: #DC3545;">Invalid or missing YouTube URL.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

