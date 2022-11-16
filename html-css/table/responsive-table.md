# Responsive basic table

### Template 
`user-list.html.php`
```php
<div class="responsive-table-container">
    <table class="responsive-table">
        <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th class="column-hidden-on-mobile">Email</th>
            <th>Status</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $user) { ?>
            <tr data-user-id="<?= $user->id ?>">
                <td><?= $user->firstName ?></td>
                <td><?= $user->surname ?></td>
                <td class="column-hidden-on-mobile"><?= $user->email ? '<a href="mailto:' . $user->email . '">' .
                        $user->email . '</a>' : '' ?></td>
                <td>
                    <select name="status" class="default-select"
                        <?= $user->statusPrivilege->hasPrivilege(Privilege::UPDATE) ? '' : 'disabled' ?>
                        >
                        <?php
                        // User status select options
                        foreach ($userStatuses as $userStatus) {
                            $selected = $userStatus === $user->status ? 'selected' : '';
                            echo "<option value='$userStatus->value' $selected>" .
                                ucfirst($userStatus->value) . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><select name="user_role_id" class="default-select"
                        <?= $user->userRolePrivilege->hasPrivilege(Privilege::UPDATE) ? '' : 'disabled' ?>
                    >
                        <?php
                        foreach ($user->availableUserRoles as $id => $userRole) {
                            $selected = $id === $user->user_role_id ? 'selected' : '';
                            echo "<option value='$id' $selected>" . $userRole . "</option>";
                        }
                        ?>
                    </select></td>
            </tr>
            <?php
        } ?>
        </tbody>
    </table>
</div>
```

### Stylesheet

`responsive-table.css`
```css
/* mobile first min-width sets base and content is adapted to computers. */
@media (min-width: 100px) {
    .responsive-table-container {
        padding: 15px 30px;
        border-radius: 30px;
        background: #f1f1f1;
        overflow-x: auto;
    }

    .responsive-table {
        width: 100%;
        border-spacing: 0;
    }

    .responsive-table tr:not(:last-child) td, .responsive-table th {
        border-bottom: 1px solid #c0c0c0;
    }

    .responsive-table td, .responsive-table th {
        padding: 12px 20px;
        text-align: left;
    }

    .responsive-table th {
        font-weight: 500;
        white-space: nowrap;
        color: black;
        letter-spacing: 0.03em;
    }
    .responsive-table a{
        color: #2e3e50;
    }

    .responsive-table tbody tr:hover {
        background: rgba(0, 0, 0, 0.05);
        cursor: pointer;
    }

    .responsive-table select {
        background: inherit;
    }

    .responsive-table a {
        text-decoration: none;
    }
    .column-hidden-on-mobile {
        display: none;
    }
}

/* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */
@media (min-width: 641px) {
}

@media (min-width: 961px) {
    /* tablet, landscape iPad, lo-res laptops ands desktops */
    .column-hidden-on-mobile {
        display: table-cell;
    }
}

@media (min-width: 1100px) {
    /* tablet, landscape iPad, lo-res laptops ands desktops */
    .responsive-table-container {
        display: inline-block;
    }
}
```

### Click event listener
`user-list-main.js`
```js
let userTableRows = document.querySelectorAll('tbody tr');
for (let tr of userTableRows){
    tr.addEventListener('click', () => {
        window.location.href = basePath + 'users/' + tr.dataset.userId;
    });
}
```
