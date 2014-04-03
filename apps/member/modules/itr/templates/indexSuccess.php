<h1>Itr submissions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Member</th>
      <th>Product</th>
      <th>Status</th>
      <th>First name</th>
      <th>Middle name</th>
      <th>Last name</th>
      <th>Dob</th>
      <th>Gender</th>
      <th>Pan no</th>
      <th>Email address</th>
      <th>Phone no</th>
      <th>Fathers name</th>
      <th>Mothers name</th>
      <th>Flat no</th>
      <th>Premises</th>
      <th>Street</th>
      <th>Area</th>
      <th>City</th>
      <th>State</th>
      <th>Country</th>
      <th>Pin</th>
      <th>Bank ac no</th>
      <th>Ac type</th>
      <th>Ifsc code</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($itr_submissions as $itr_submission): ?>
    <tr>
      <td><a href="<?php echo url_for('itr/edit?id='.$itr_submission->getId()) ?>"><?php echo $itr_submission->getId() ?></a></td>
      <td><?php echo $itr_submission->getMemberId() ?></td>
      <td><?php echo $itr_submission->getProductId() ?></td>
      <td><?php echo $itr_submission->getStatus() ?></td>
      <td><?php echo $itr_submission->getFirstName() ?></td>
      <td><?php echo $itr_submission->getMiddleName() ?></td>
      <td><?php echo $itr_submission->getLastName() ?></td>
      <td><?php echo $itr_submission->getDob() ?></td>
      <td><?php echo $itr_submission->getGender() ?></td>
      <td><?php echo $itr_submission->getPanNo() ?></td>
      <td><?php echo $itr_submission->getEmailAddress() ?></td>
      <td><?php echo $itr_submission->getPhoneNo() ?></td>
      <td><?php echo $itr_submission->getFathersName() ?></td>
      <td><?php echo $itr_submission->getMothersName() ?></td>
      <td><?php echo $itr_submission->getFlatNo() ?></td>
      <td><?php echo $itr_submission->getPremises() ?></td>
      <td><?php echo $itr_submission->getStreet() ?></td>
      <td><?php echo $itr_submission->getArea() ?></td>
      <td><?php echo $itr_submission->getCity() ?></td>
      <td><?php echo $itr_submission->getState() ?></td>
      <td><?php echo $itr_submission->getCountry() ?></td>
      <td><?php echo $itr_submission->getPin() ?></td>
      <td><?php echo $itr_submission->getBankAcNo() ?></td>
      <td><?php echo $itr_submission->getAcType() ?></td>
      <td><?php echo $itr_submission->getIfscCode() ?></td>
      <td><?php echo $itr_submission->getCreatedAt() ?></td>
      <td><?php echo $itr_submission->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('itr/new') ?>">New</a>
