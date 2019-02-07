# Flash messages

### Start session
First of all you need to make sure that a session is started. This can be done like this for example on the top of the controller:
```php
<?php
if (!session_id()) {
    session_start();
}
```

### Class Flash.php

```php
<?php

/**
 * Class to create and display error and success messages
 */
class Flash {

    /**
     * This function can set a flash message
     * @param string $name The name of the message
     * @param string $message The actual message which gets displayed
     * @param string $class CSS class 
     * @return bool
     */
    public static function setFlash($name = '', $message = '', $class = '') {
        //No message, create it
        if (!empty($name) && !empty($message)) {
            // If a flash message with the same name exists already, it will get removed
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
            return true;
        }
        return false;
    }

    /**
     * Returns all flash messages
     * @return array|bool
     */
    public static function getAllFlash() {
        foreach ($_SESSION as $key => $value) {
            // Check key is not the class 
            if (!strpos($key, '_class')) {
                $class = $_SESSION[$key . '_class'];
                $msg = $value;
                unset($_SESSION[$key], $_SESSION[$key . '_class']);
                $messages[] = ['msg' => $msg, 'class' => $class];
            }
        }
        if (!empty($messages)) {
            return $messages;
        }
        return false;
    }

    /**
     * Returns one flash message
     * @param $name Name of the message
     * @return array|bool
     */
    public static function getFlashMessageByName($name) {
        //Message exists, display it
        if (!empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'success';
            $msg = $_SESSION[$name];
            unset($_SESSION[$name], $_SESSION[$name . '_class']);
            return ['msg' => $msg, 'class' => $class];
        }
        return false;
    }
}
```

### Adding CSS

```css
/* Message */
.msg {
    background: white;
    text-align: center;
    color: black;
}

.success {
    background-color: #4BB543;
}

.error {
    background: #b2180e;
    color: white;
}
```

### Usage

**Set a message**
```php
Flash::setFlash('added_client', 'New client successfully saved','success');
Flash::setFlash('place_already_exists', 'This class exists already','error');
```

**Display all messages**
```php
<?php
$messages = Flash::getAllFlash();
if (!empty($messages)) {
    foreach ($messages as $message) {
        echo '<div class="msg ' . $message['class'] . '">
            ' . $message['msg'] . '
            </div>';
    }
}
```

***

Source: https://phpdevtips.com/2013/05/simple-session-based-flash-messages/
