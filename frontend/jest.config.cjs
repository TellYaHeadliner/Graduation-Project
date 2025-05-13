module.exports = {
    preset: 'ts-jest',
    testEnviroment: 'jsdom',
    setupFileAfterEnv: ['<rootDir>/src/setupTests.ts'],
    moduleNameMapper: {
        '\\.(css|less|scss|sass)$': 'identity-obj-proxy',
    },
};