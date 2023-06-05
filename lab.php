
<!DOCTYPE html>
<html>
<head>
  <title>Student Registration Form</title>
</head>
<body>
  <h1>Student Registration Form</h1>
  <?php if (isset($success)): ?>
    <p>Registration successful!</p>
  <?php else: ?>
    <?php if (!empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form method="post" action="submit.php">
      <label for="full_name">Full Name:</label>
      <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required>
      <br>
      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
      <br>
      <label for="gender">Gender:</label>
      <select id="gender" name="gender" required>
        <option value="">Select</option>
        <option value="male" <?php if ($gender === 'male') echo 'selected'; ?>>Male</option>
        <option value="female" <?php if ($gender === 'female') echo 'selected'; ?>>Female</option>
        <option value="other" <?php if ($gender === 'other') echo 'selected'; ?>>Other</option>
      </select>
      <br>
      <input type="submit" value="Submit">
    </form>
  <?php endif; ?>
</body>
</html>