gemini.suite('storyboard', (suite) => {
    suite.setUrl('/iframe.html?selectedKind=Components%2FUserSelect&selectedStory=Default&full=0&addons=1&stories=1&panelRight=0&addonPanel=storybook%2Factions%2Factions-panel')
        .setCaptureElements('[data-storybook-container]')
        .capture('plain');
});
