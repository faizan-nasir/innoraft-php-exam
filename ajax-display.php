<?php foreach ($res as $i) : ?>
  <tr>
    <td><?= $i['id'] ?></td>
    <td><?= $i['email'] ?></td>
    <td data-name=<?= $i['stock'] ?>><?= $i['stock'] ?></td>
    <td data-price=<?= $i['stock'] ?>><?= $i['price'] ?></td>
    <td><?= $i['created'] ?></td>
    <td><?= $i['last_updated'] ?></td>
    <?php if ($i['email'] == $_SESSION['email']) : ?>
      <td>
        <button data-id="<?= $i['id'] ?>" class="<?= $cls ?>"><?= $task ?></button>
      </td>
    <?php endif ?>
  </tr>
<?php
endforeach;
