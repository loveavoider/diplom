import { Box, Button } from "@chakra-ui/react";
import {sendPost, sendPatch} from "@/app/util/axios";
import {useState} from "react";

async function createTask(data, setCreated) {
    const res = await sendPost(data, 'task', true);

    if (res.status === 201 && res.data.score) {
        setCreated({end: true, was: true});
    } else {
        setCreated({end: false, was: true});
    }
}

async function updateTask(data, setCreated) {
    const { id } = data;

    const res = await sendPatch(data, `task/${id}`, true);

    if (res.status === 200) {
        setCreated({end: true, was: true});
    } else {
        setCreated({end: false, was: true});
    }
}

async function Score(isCreate, formData, setCreated, setId) {
    if (isCreate) {
        createTask(formData, setCreated, setId); // нарисовать что все ок
    } else {
        updateTask(formData, setCreated);
    }
}

function ScoringRes({was, end}) {
    return (
        <Box>
            {!was && !end ? '' : was && !end ?
                <Box>Скоринг не пройден, сумма гарантии превышает НМЦ больше чем в 2 раза</Box>
                : <Box>Вы успешно прошли скоринг</Box>}
        </Box>
    )
}

export default function Scoring({ formData, isCreate, tab }) {

    const [created, setCreated] = useState({end: false, was: false});

    return (
        <Box>
            {
                tab > 1 || (created.end && created.was) ? '' : <Button colorScheme="blue"
                      onClick={() => Score(isCreate, formData, setCreated)}>Пройти скоринг</Button>
            }
            {
                tab > 1 ? <Box>Вы успешно прошли скориг</Box> : ''
            }
            <ScoringRes was={created.was} end={created.end} />
        </Box>
    )
}