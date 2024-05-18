import { Box, Button } from "@chakra-ui/react";
import {sendPost, sendPatch} from "@/app/util/axios";

async function createTask(data) {
    const res = await sendPost(data, 'task', true);
    console.log(res);
}

async function updateTask(data) {
    const { id } = data;

    const res = await sendPatch(data, `task/${id}`, true);
    console.log(res);
}

async function Score(isCreate, formData) {
    if (isCreate) {
        createTask(formData); // нарисовать что все ок
    } else {
        updateTask(formData);
    }
}

export default function Scoring({ formData, isCreate }) {
    return (
        <Box>
            <Button colorScheme="blue" onClick={() => Score(isCreate, formData)}>Пройти скоринг</Button>
        </Box>
    )
}