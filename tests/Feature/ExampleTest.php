<?php

test('the application redirects visitors to leave requests', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('leave-requests.index'));
});
