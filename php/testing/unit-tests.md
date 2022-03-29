# Unit testing
I started testing with unit tests, so I wrote extensive unit test cases. 
When started to write integration tests I realized that they cover more code and 
even the database while being often more simple to implement.  
Citation of Daniel Opitz from [this conversation](https://github.com/odan/slim4-tutorial/issues/45):

> When you implement an integration tests for an API endpoint, you can cover everything from the action (controller), Domain (business logic) and the data access logic with just some lines of test code. Then you can change the complete implementation behind it and the test should still work. I think this is how tests should work, right?

> So for me, it would make no sense to write extra unit-tests for each service or repository class, because this is too hard to maintain. Refactoring will become very stressful, because you have to refactor the unit-tests as well. So your unit tests are not a good indicator if the application works like before the refactoring. And this is not why we write tests, a test should be green before and after the refactoring. Then you know that writing tests makes actually sense and is worth the extra effort.

As I already wrote a lot I now have to delete them, but still think that they
can be useful as I learned testing with them. Here are some examples:

## Table of contents
* [`PostFinderTest.php`](#PostFinderTest.php)
* [`PostUpdaterTest.php`](#PostUpdaterTest.php)
* [`PostCreatorTest.php`](#PostCreatorTest.php)
* [`PostDeleterTest.php`](#PostDeleterTest.php)
* [`RegisterTokenVerifierTest.php`](#RegisterTokenVerifierTest.php)


## `PostFinderTest.php`
```php
<?php

namespace App\Test\Unit\Post;

use App\Domain\Post\Data\PostData;
use App\Domain\Post\Data\UserPostData;
use App\Domain\Post\Service\PostFinder;
use App\Infrastructure\Post\PostFinderRepository;
use App\Test\Traits\AppTestTrait;
use PHPUnit\Framework\TestCase;

class PostFinderTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test function findAllPostsWithUsers from PostFinder which returns
     * Post array including the associated user
     *
     * @dataProvider \App\Test\Provider\Post\PostDataProvider::oneSetOfMultipleUserPostsProvider()
     * @param UserPostData[] $userPosts
     */
    public function testFindAllPostsWithUsers(array $userPosts): void
    {
        // Add mock class PostFinderRepository to container and define return value for method findAllPostsWithUsers
        $this->mock(PostFinderRepository::class)->method('findAllPostsWithUsers')->willReturn($userPosts);


        // Here we don't need to specify what the service function will do / return since its exactly that
        // which is being tested. So we can take the autowired class instance from the container directly.
        /** @var PostFinder $service */
        $service = $this->container->get(PostFinder::class);

        self::assertEquals($userPosts, $service->findAllPostsWithUsers());

    }

    /**
     * Check if findPost() from PostFinder returns
     * the post coming from the repository
     *
     * @dataProvider \App\Test\Provider\Post\PostDataProvider::onePostProvider()
     * @param array $postData
     */
    public function testFindPost(array $postData): void
    {
        $post = new PostData($postData);
        // Add mock class PostFinderRepository to container and define return value for method findPostById
        // I dont see the necessity of expecting method to be called. If we get the result we want
        // we can let the code free how it returns it (don't want annoying test that fails after slight code change)
        $this->mock(PostFinderRepository::class)->method('findPostById')->willReturn($post);

        // Get an empty class instance from container
        /** @var PostFinder $service */
        $service = $this->container->get(PostFinder::class);

        self::assertEquals($post, $service->findPost($post->id));
    }

    /**
     * Check if findAllPostsFromUser() from PostFinder returns
     * the posts coming from the repository AND
     * if the user names are contained in the returned array
     *
     * @dataProvider \App\Test\Provider\Post\PostDataProvider::oneSetOfMultipleUserPostsProvider()
     * @param UserPostData[] $userPosts
     */
    public function testFindAllPostsFromUser(array $userPosts): void
    {
        // Add mock class PostFinderRepository to container and define return value for method findPostById
        // Posts are with different user_ids from provider and logically findAllPostsFromUser has to return
        // posts with the same user_id since they belong to the same user. But this is not the point of the test.
        // The same posts array will be used in the assertions
        $this->mock(PostFinderRepository::class)->method('findAllPostsByUserId')->willReturn($userPosts);

        /** @var PostFinder $service */
        $service = $this->container->get(PostFinder::class);

        // User id not relevant because return values from repo is defined above
        self::assertEquals($userPosts, $service->findAllPostsFromUser(1));
    }
}
```
### `PostDataProvider.php`
```php
<?php

namespace App\Test\Provider\Post;

use App\Domain\Post\Data\PostData;
use App\Domain\Post\Data\UserPostData;
use App\Domain\User\Data\UserData;

class PostDataProvider
{
    public array $samplePosts = [
        ['id' => 1, 'user_id' => 1, 'message' => 'This is the first test message'],
        ['id' => 2, 'user_id' => 2, 'message' => 'This is the second test message'],
        ['id' => 3, 'user_id' => 3, 'message' => 'This is the third test message'],
        ['id' => 4, 'user_id' => 4, 'message' => 'This is the fourth test message'],
        ['id' => 5, 'user_id' => 5, 'message' => 'This is the fifth test message'],
    ];

    /**
     * Provide a set of posts attached to same user in a DataProvider format
     *
     * @return UserPostData[][][]
     */
    public function oneSetOfMultipleUserPostsProvider(): array
    {
        // Array that is expected for repository functions like findAllPostsWithUsers()
        return [
            [
                'posts' => [
                    new UserPostData([
                                         'post_id' => 1,
                                         'user_id' => 1,
                                         'post_message' => 'This is the first test message',
                                         'post_created_at' => date('Y-m-d H:i:s'),
                                         'post_updated_at' => date('Y-m-d H:i:s'),
                                         'user_name' => 'Admin Example',
                                         'user_role' => 'admin',
                                     ]),
                    new UserPostData([
                                         'post_id' => 2,
                                         'user_id' => 1,
                                         'post_message' => 'This is the second test message',
                                         'post_created_at' => date('Y-m-d H:i:s'),
                                         'post_updated_at' => date('Y-m-d H:i:s'),
                                         'user_name' => 'Admin Example',
                                         'user_role' => 'admin',
                                     ]),

                ],
            ],
        ];
    }

    /**
     * Provide one user in a DataProvider format
     *
     * @return array<array<array>>
     */
    public function onePostProvider(): array
    {
        return [
            [
                ['id' => 1, 'user_id' => 1, 'message' => 'Test message', 'created_at' => date('Y-m-d H:i:s')],
            ]
        ];
    }

    /**
     * Unit test invalid post provider
     *
     * @return array<array<array>> invalid post data
     */
    public function invalidPostsProvider(): array
    {
        $tooLongMsg = 'iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
            iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
            iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
            iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
            iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii';
        return [
            // Msg too short (>4)
            [['id' => 1, 'user_id' => 1, 'message' => 'aaa']],
            // Msg too long (<500)
            [['id' => 1, 'user_id' => 1, 'message' => $tooLongMsg]],
            // Required msg empty
            [['id' => 1, 'user_id' => 1, 'message' => '']],
            // Required user_id missing
            [['id' => 1, 'user_id' => '', 'message' => '']],
        ];
        // Could add more rows with always 1 required missing because now error could be thrown
        // by another missing field.
    }
}
```
## `PostUpdaterTest.php`
```php
<?php

namespace App\Test\Unit\Post;

use App\Domain\Exceptions\ForbiddenException;
use App\Domain\Post\Data\PostData;
use App\Domain\Post\Service\PostFinder;
use App\Domain\Post\Service\PostUpdater;
use App\Infrastructure\Authentication\UserRoleFinderRepository;
use App\Infrastructure\Post\PostUpdaterRepository;
use App\Test\Traits\AppTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Post update unit test covered here:
 * - normal update
 * - edit other post as user (403 Forbidden)
 * - edit other post as admin
 * NOT in this test (not useful enough to me):
 * - edit non-existing post as admin (expected return value false)
 * - edit non-existing post as user (expected forbidden exception)
 * - make edit request but with the same content as before (expected not updated response)
 */
class PostUpdaterTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test that service method updatePost() calls PostUpdaterRepository:updatePost()
     * and that (service) updatePost() returns the bool true returned by repo
     *
     * Invalid or not existing user don't have to be tested since it's the same
     * validation as registerUser() and it's already done there
     */
    public function testUpdatePost(): void
    {
        $userRole = 'user';
        $postId = 1;
        $postUserId = 1;
        $loggedInUserId = 1;
        $valuesToChange = ['message' => 'This is a new message content.'];

        // Post from db used to check ownership
        $postFromDb = new PostData(['id' => $postId, 'user_id' => $postUserId, 'message' => 'Test message.']);
        $this->mock(PostFinder::class)->method('findPost')->willReturn($postFromDb);

        // User role 'user'
        $this->mock(UserRoleFinderRepository::class)->method('getUserRoleById')->willReturn($userRole);

        // With ->expects() to assert that the method is called
        $this->mock(PostUpdaterRepository::class)->expects(self::once())->method('updatePost')->willReturn(true);

        /** @var PostUpdater $service */
        $service = $this->container->get(PostUpdater::class);

        self::assertTrue($service->updatePost($postId, $valuesToChange, $loggedInUserId));
    }

    /**
     * Test that user cannot edit post attached to other user
     */
    public function testUpdatePost_otherPostAsUser(): void
    {
        $userRole = 'user';
        $postId = 1;
        $postUserId = 2; // Different from logged-in
        $loggedInUserId = 1;
        $valuesToChange = ['message' => 'This is a new message content.'];

        // Post from db used to check ownership
        $postFromDb = new PostData(['id' => $postId, 'user_id' => $postUserId, 'message' => 'Test message.']);
        $this->mock(PostFinder::class)->method('findPost')->willReturn($postFromDb);

        // User role 'user'
        $this->mock(UserRoleFinderRepository::class)->method('getUserRoleById')->willReturn($userRole);

        // Assert that updatePost() is NOT called
        $this->mock(PostUpdaterRepository::class)->expects(self::never())->method('updatePost');

        /** @var PostUpdater $service */
        $service = $this->container->get(PostUpdater::class);

        $this->expectException(ForbiddenException::class);

        $service->updatePost($postId, $valuesToChange, $loggedInUserId);
    }

    /**
     * Test that admin CAN edit post attached to other user
     */
    public function testUpdatePost_otherPostAsAdmin(): void
    {
        $userRole = 'admin';
        $postId = 1;
        $postUserId = 2; // Different from logged-in user
        $loggedInUserId = 1;
        $valuesToChange = ['message' => 'This is a new message content.'];

        // Post from db used to check ownership
        $postFromDb = new PostData(['id' => $postId, 'user_id' => $postUserId, 'message' => 'Test message.']);
        $this->mock(PostFinder::class)->method('findPost')->willReturn($postFromDb);

        // User role
        $this->mock(UserRoleFinderRepository::class)->method('getUserRoleById')->willReturn($userRole);

        // Assert that repo method updatePost() is called
        $this->mock(PostUpdaterRepository::class)->expects(self::once())->method('updatePost')->willReturn(true);

        /** @var PostUpdater $service */
        $service = $this->container->get(PostUpdater::class);

        self::assertTrue($service->updatePost($postId, $valuesToChange, $loggedInUserId));
    }

}
```

## `PostCreatorTest.php`
```php
<?php

namespace App\Test\Unit\Post;

use App\Domain\Exceptions\ValidationException;
use App\Domain\Post\Data\PostData;
use App\Domain\Post\Service\PostCreator;
use App\Infrastructure\User\UserExistenceCheckerRepository;
use App\Test\Traits\AppTestTrait;
use PHPUnit\Framework\TestCase;

class PostCreatorTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test that service method createPost() calls PostCreatorRepository:insertPost()
     * and that (service) createPost() returns the id returned from (repo) insertPost()
     *
     * @dataProvider \App\Test\Provider\Post\PostDataProvider::onePostProvider()
     * @param array $validPostData
     */
    public function testCreatePost(array $validPostData): void
    {
        // Mock the required repository and configure relevant method return value
        // Here I find ->expects() relevant since the test is about if the method is called or not
        // but should the expected parameter be tested as well? ->with($this->equalTo($validPost)) not included
        // because I don't want an annoying test function that fails for nothing if code changes. Didn't see the
        // real need for a test, but maybe I'm wrong.
        $this->mock(PostCreator::class)->expects(self::once())->method('createPost')->willReturn(1);

        // Mock because it is used in the validation logic.
        $this->mock(UserExistenceCheckerRepository::class)->method('userExists')->willReturn(true);

        /** @var PostCreator $postCreator */
        $postCreator = $this->container->get(PostCreator::class);

        self::assertEquals(1, $postCreator->createPost($validPostData, 1));
    }

    /**
     * Test that no post is created when values are invalid.
     * validatePostCreationOrUpdate() will be tested separately but
     * here it is ensured that this validation is called in registerUser
     * but without specific error analysis. Important is that it didn't create it.
     * The method is called with each value of the provider
     *
     * @dataProvider \App\Test\Provider\Post\PostDataProvider::invalidPostsProvider()
     * @param array $invalidPost
     */
    public function testCreatePost_invalid(array $invalidPost): void
    {
        // Mock because it is used by the validation logic.
        // Empty mock would do the trick as well as it would just return null on non defined functions.
        // A post is linked to an user in all cases so user has to exist. What happens if user doesn't exist
        // will be tested in a different function otherwise this test would always fail and other invalid
        // values would not be noticed
        $this->mock(UserExistenceCheckerRepository::class)->method('userExists')->willReturn(true);

        /** @var PostCreator $service */
        $service = $this->container->get(PostCreator::class);

        $this->expectException(ValidationException::class);

        $service->createPost($invalidPost, 1);
        // If we wanted to test more detailed, the error messages could be tested, that the right message(s) appear
    }

    /**
     * Test createPost when user doesn't exist
     *
     * @dataProvider \App\Test\Provider\Post\PostDataProvider::onePostProvider()
     * @param array $validPost
     */
    public function testCreatePost_notExistingUser(array $validPost): void
    {
        // Point of this test is not existing user
        $this->mock(UserExistenceCheckerRepository::class)->method('userExists')->willReturn(false);

        /** @var PostCreator $service */
        $service = $this->container->get(PostCreator::class);

        $this->expectException(ValidationException::class);

        $service->createPost($validPost, 1);
    }
}
```

## `PostDeleterTest.php`
```php
<?php

namespace App\Test\Unit\Post;

use App\Domain\Exceptions\ForbiddenException;
use App\Domain\Post\Data\PostData;
use App\Domain\Post\Service\PostDeleter;
use App\Domain\Post\Service\PostFinder;
use App\Infrastructure\Authentication\UserRoleFinderRepository;
use App\Infrastructure\Post\PostDeleterRepository;
use App\Test\Traits\AppTestTrait;
use PHPUnit\Framework\TestCase;

class PostDeleterTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test that PostDeleterRepository:deletePost() is called in post service when
     * user tried to delete its own post
     */
    public function testDeletePost_ownPost(): void
    {
        $postId = 1;
        // Logged-in user same than user_id of post
        $postUserId = 1;
        $loggedInUserId = 1;
        $userRole = 'user';

        // User role 'user'
        $this->mock(UserRoleFinderRepository::class)->method('getUserRoleById')->willReturn($userRole);

        // Post from db used to check ownership
        $postFromDb = new PostData(['id' => 1, 'user_id' => $postUserId, 'message' => 'Test message.']);
        $this->mock(PostFinder::class)->method('findPost')->willReturn($postFromDb);

        $this->mock(PostDeleterRepository::class)
            ->expects(self::once())
            ->method('deletePost')
            // With parameter post id
            ->with(self::equalTo($postId))
            ->willReturn(true);

        /** @var PostDeleter $service */
        $service = $this->container->get(PostDeleter::class);

        self::assertTrue($service->deletePost($postId, $loggedInUserId));
    }

    /**
     * Test that ForbiddenException is thrown when user tries to delete post
     * that he doesn't own.
     */
    public function testDeletePost_otherPostAsUser(): void
    {
        $postId = 1;
        $postUserId = 1;
        // Logged-in user different from user_id of post
        $loggedInUserId = 2;
        $userRole = 'user';

        // User role 'user'
        $this->mock(UserRoleFinderRepository::class)->method('getUserRoleById')->willReturn($userRole);

        // Post from db used to check ownership which WILL NOT correspond
        $postFromDb = new PostData(['id' => 1, 'user_id' => $postUserId, 'message' => 'Test message.']);
        $this->mock(PostFinder::class)->method('findPost')->willReturn($postFromDb);

        // deletePost should NEVER be called
        $this->mock(PostDeleterRepository::class)->expects(self::never())->method('deletePost');

        /** @var PostDeleter $service */
        $service = $this->container->get(PostDeleter::class);

        $this->expectException(ForbiddenException::class);

        $service->deletePost($postId, $loggedInUserId);
    }


    /**
     * Test that admin can delete post that he doesn't own
     */
    public function testDeletePost_otherPostAsAdmin(): void
    {
        $postId = 1;
        // Logged-in user DIFFERENT from user_id of post
        $postUserId = 1;
        $loggedInUserId = 2;
        $userRole = 'admin';

        // User role
        $this->mock(UserRoleFinderRepository::class)->method('getUserRoleById')->willReturn($userRole);

        // Post from db used to check ownership
        $postFromDb = new PostData(['id' => 1, 'user_id' => $postUserId, 'message' => 'Test message.']);
        $this->mock(PostFinder::class)->method('findPost')->willReturn($postFromDb);

        $this->mock(PostDeleterRepository::class)
            ->expects(self::once())
            ->method('deletePost')
            // With parameter post id
            ->with(self::equalTo($postId))
            ->willReturn(true);

        /** @var PostDeleter $service */
        $service = $this->container->get(PostDeleter::class);

        self::assertTrue($service->deletePost($postId, $loggedInUserId));
    }

}
```

## `RegisterTokenVerifierTest.php`
```php
<?php

namespace App\Test\Unit\Authentication;

use App\Domain\Authentication\Data\UserVerificationData;
use App\Domain\Authentication\Exception\InvalidTokenException;
use App\Domain\Authentication\Exception\UserAlreadyVerifiedException;
use App\Domain\Authentication\Service\RegisterTokenVerifier;
use App\Domain\User\Data\UserData;
use App\Infrastructure\Authentication\VerificationToken\VerificationTokenFinderRepository;
use App\Infrastructure\Authentication\VerificationToken\VerificationTokenUpdaterRepository;
use App\Infrastructure\User\UserFinderRepository;
use App\Infrastructure\User\UserUpdaterRepository;
use App\Test\Traits\AppTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Email verification test (after user clicked on link)
 */
class RegisterTokenVerifierTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test that with valid values all security checks pass until changeUserStatus is called
     *
     * @dataProvider \App\Test\Provider\Authentication\UserVerificationDataProvider::userVerificationProvider
     * @param UserVerificationData $verification
     * @param string $clearTextToken
     */
    public function testGetUserIdIfTokenIsValid(UserVerificationData $verification, string $clearTextToken): void
    {
        // Create mocks
        $userVerificationFinderRepository = $this->mock(VerificationTokenFinderRepository::class);

        // Return valid verification object from repository
        $userVerificationFinderRepository->method('findUserVerification')->willReturn($verification);
        // Set user id that should be returned by the function under test for a success
        $userVerificationFinderRepository->method('getUserIdFromVerification')->willReturn(1);

        // Return unverified user (empty user, only status is populated)
        $this->mock(UserFinderRepository::class)->expects(self::once())->method('findUserById')->willReturn(
        // IMPORTANT: user has to be unverified for the test to succeed
            new UserData(['status' => UserData::STATUS_UNVERIFIED])
        );
        // Making sure that changeUserStatus is called
        $this->mock(UserUpdaterRepository::class)->expects(self::once())->method('changeUserStatus')->willReturn(true);
        // Assert that setVerificationEntryToUsed is called
        $this->mock(VerificationTokenUpdaterRepository::class)->expects(self::once())->method('setVerificationEntryToUsed')->willReturn(true);

        $tokenVerifier = $this->container->get(RegisterTokenVerifier::class);
        // Call function under test
        self::assertSame(1, $tokenVerifier->getUserIdIfTokenIsValid($verification->id, $clearTextToken));
    }

    /**
     * Case when user clicks on the link even though the user is not 'unverified' anymore
     *
     * @dataProvider \App\Test\Provider\Authentication\UserVerificationDataProvider::userVerificationProvider
     * @param UserVerificationData $verification
     * @param string $clearTextToken
     */
    public function testGetUserIdIfTokenIsValid_alreadyVerified(
        UserVerificationData $verification,
        string $clearTextToken
    ): void {
        // Return valid verification object from repository
        $this->mock(VerificationTokenFinderRepository::class)->expects(self::once())->method(
            'findUserVerification'
        )->willReturn($verification);
        // Return active user (empty user, only status is populated)
        $this->mock(UserFinderRepository::class)->expects(self::once())->method('findUserById')->willReturn(
        // IMPORTANT: user has to be already active for exception to be thrown
            new UserData(['status' => UserData::STATUS_ACTIVE])
        );

        $this->expectException(UserAlreadyVerifiedException::class);
        $this->expectExceptionMessage('User has not status "' . UserData::STATUS_UNVERIFIED . '"');

        // Call function under test
        $this->container->get(RegisterTokenVerifier::class)->getUserIdIfTokenIsValid(
            $verification->id,
            $clearTextToken
        );
    }

    /**
     * Link in email contains the verification db entry id and if this id is incorrect (token not found)
     * according exception should be thrown
     */
    public function testGetUserIdIfTokenIsValid_notExistingToken(): void
    {
        // Return empty verification object from repository. That means that entry was not found
        $this->mock(VerificationTokenFinderRepository::class)->expects(self::once())->method(
            'findUserVerification'
        )->willReturn(new UserVerificationData()); // Empty class means nothing was found

        $verificationId = 1;
        $this->expectException(InvalidTokenException::class);
        $this->expectExceptionMessage('No token was found for id "' . $verificationId . '".');

        // Call function under test with invalid verification id (token doesn't matter in this test)
        $this->container->get(RegisterTokenVerifier::class)->getUserIdIfTokenIsValid(
            $verificationId,
            'wrongTokenButItDoesntMatter'
        );
    }

    /**
     * Test when token is invalid or expired
     *
     * Provider gives once an invalid token and once an expired one
     * @dataProvider \App\Test\Provider\Authentication\UserVerificationDataProvider::userVerificationInvalidExpiredProvider
     *
     * @param UserVerificationData $verification Once expired
     * @param string $clearTextToken Once valid, once invalid
     */
    public function testGetUserIdIfTokenIsValid_invalidExpiredToken(
        UserVerificationData $verification,
        string $clearTextToken
    ): void {
        // Return valid verification object from repository
        $this->mock(VerificationTokenFinderRepository::class)->expects(self::once())->method(
            'findUserVerification'
        )->willReturn($verification);
        // Return active user (empty user, only status is populated)
        $this->mock(UserFinderRepository::class)->expects(self::once())->method('findUserById')->willReturn(
        // User has to be unverified as this is the default value and its not purpose of this test
            new UserData(['status' => UserData::STATUS_UNVERIFIED])
        );

        $this->expectException(InvalidTokenException::class);
        $this->expectExceptionMessage('Invalid or expired token.');

        // Call function under test
        $this->container->get(RegisterTokenVerifier::class)->getUserIdIfTokenIsValid(
            $verification->id,
            $clearTextToken
        );
    }
}
```